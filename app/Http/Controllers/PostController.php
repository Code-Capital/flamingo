<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $feeds = Post::byPublished()
            ->byPublic()
            ->with(['user', 'media', 'likes', 'comments', 'comments.user', 'comments.replies'])
            ->withCount(['comments', 'likes'])
            ->latest()
            // byUser($user)
            ->paginate(getPaginated());

        return view('user.feed', get_defined_vars());
    }

    public function store(Request $request): RedirectResponse
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
                    $mediaPath = $mediaFile->store('media/'.$user->id, 'public'); // Example storage path
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

        return back()->with('success', 'Post created successfully');
    }
}
