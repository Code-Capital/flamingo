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
        $feeds = Post::byUser($user)
            ->byPublished()
            ->byPublic()
            ->with(['media', 'comments', 'likes'])
            ->with('user:id,name,avatar')
            ->withCount(['comments', 'likes'])
            ->latest()
            ->get();
//            ->paginate(getPaginated());
//        dd($feeds->toArray());
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
                    $mediaPath = $mediaFile->store('media/' . $user->id, 'public'); // Example storage path
                    $post->media()->create([
                        'file_path' => $mediaPath,
                        'file_type' => $mediaFile->getClientOriginalExtension(), // Example file type
                    ]);
                }
            }

            $post->comments()->create([
                'body' => 'Post created',
                'user_id' => $user->id,
            ]);

            $post->likes()->create([
                'user_id' => $user->id,
                'is_liked' => true
            ]);

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
