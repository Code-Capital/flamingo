<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Casts\Json;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $currentUser = $user;

        // Get the user's friends
        $friends = $user->acceptedFriends->pluck('id');

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
                }, 'comments.user', 'comments.replies',
            ])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->paginate(getPaginated());


        $peoples = getPeoples($user);

        return view('user.feed', get_defined_vars());
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = Auth::user();
            $post = $user->posts()->create([
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

            $post->notifications()->create([
                'type' => 'post',
                'data' => json_encode([
                    'message' => 'New post created',
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]),
            ]);
        });

        if ($request->ajax()) {
            return $this->sendSuccessResponse(null, 'Post created successfully', Response::HTTP_CREATED);
        } else {
            return back()->with('success', 'Post created successfully');
        }
    }

    public function show(User $user): View
    {

        $currentUser = Auth::user();

        if ($currentUser && $currentUser->id !== $user->id) {
            // Record the visit
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
            ->with(['user', 'media', 'likes', 'comments', 'comments.user', 'comments.replies'])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->paginate(getPaginated());

        $peoples = getPeoples($user);
        return view('user.feed', get_defined_vars());
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return $this->sendSuccessResponse('Post deleted successfully');
    }
}
