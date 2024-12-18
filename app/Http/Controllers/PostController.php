<?php

namespace App\Http\Controllers;

use App\Enums\NotificationStatusEnum;
use App\Jobs\SendPostNotificationJob;
use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $currentUser = $user;

        // Get the user's friends
        $friends = $user->acceptedFriends->pluck('id');
        $friends->push(1);
        // Fetch posts by the authenticated user and their friends
        $feeds = Post::whereIn('user_id', $friends->push($user->id))
            ->byPublished()
            ->byPublic()
            ->with([
                'user',
                'media',
                'likes',
                'comments' => function ($query) {
                    $query->withCount(['replies']);
                },
                'comments.user',
                'comments.replies',
                'reports',
            ])
            ->withCount(['comments', 'likes'])
            ->whereDoesntHave('reports', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->paginate(getPaginated(5));

        $peoples = getPeoples($user);

        return view('user.feed', get_defined_vars());
    }

    public function show(?User $user = null): View
    {

        $currentUser = Auth::user();
        $loginUser = $user;

        if ($currentUser && $currentUser->id !== $user->id) {
            Visitor::updateOrCreate(
                [
                    'visitor_id' => $currentUser->id,
                    'profile_id' => $user->id,
                    'created_at' => now()->startOfDay(), // Ensure a visit is unique per day
                ],
                [
                    'visitor_id' => $currentUser->id,
                    'profile_id' => $user->id,
                    'created_at' => now()->startOfDay(), // Ensure a visit is unique per day
                ]
            );
        }

        $feeds = $user->posts()
            ->byPublished()
            ->byPublic()
            // ->ByNotReportedByUser($user)
            ->with([
                'user',
                'media',
                'likes',
                'comments',
                'comments.user',
                'comments.replies',
                'reports',
            ])
            ->whereDoesntHave('reports', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->withCount(['comments', 'likes', 'reports'])
            ->latest()
            ->paginate(getPaginated());

        $peoples = getPeoples($user);

        return view('user.feed', get_defined_vars());
    }

    public function store(Request $request): RedirectResponse|JsonResponse
    {
        DB::transaction(function () use ($request) {
            $user = Auth::user();
            $post = $user->posts()->create([
                'uuid' => Str::uuid(),
                'body' => $request->body,
                'is_private' => $request->is_private ?? false,
            ]);

            // Check if media files were uploaded
            if ($request->hasFile('media')) {
                $mediaFiles = $request->file('media');
                foreach ($mediaFiles as $mediaFile) {
                    $mediaPath = $mediaFile->store('/media/posts/' . $user->id, 'public'); // Example storage path
                    $post->media()->create([
                        'file_path' => $mediaPath,
                        'file_type' => $mediaFile->getClientOriginalExtension(), // Example file type
                    ]);
                }
            }

            if ($post->isPublic()) {
                dispatch(new SendPostNotificationJob($post, $user));
            }

            $link = route('post.edit', $post->uuid);
            $notification_message = __("New post has been created by");


            $body = limitString($post->body, 20);
            $message = "<div class='notification'>
                            {$notification_message} {$user->user_name}: <a href='{$link}' target='_blank'> {$body}</a>
                        </div>
                    ";

            $post->user->notifications()->create([
                'type' => NotificationStatusEnum::POSTCREATED->value,
                'data' => json_encode([
                    'message' => $message,
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'post_body' => $post->body,
                    'user_name' => $user->user_name,
                ]),
            ]);
        });

        if ($request->ajax()) {
            return $this->sendSuccessResponse(null, 'Post created successfully', Response::HTTP_CREATED);
        } else {
            return back()->with('success', 'Post created successfully');
        }
    }

    public function edit(Post $post): View
    {
        $currentUser = Auth::user();
        $peoples = getPeoples($currentUser);
        $posts = $post->byPublished()
            ->byPublic()
            ->with([
                'user',
                'media',
                'likes',
                'comments' => function ($query) {
                    $query->withCount(['replies']);
                },
                'comments.user',
                'comments.replies',
            ])
            ->withCount(['comments', 'likes'])->first();

        return view('user.posts.show', get_defined_vars());
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return $this->sendSuccessResponse('Post deleted successfully');
    }
}
