<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Post $post): JsonResponse
    {
        $user = auth()->user();

        // Check if the user has already liked the post
        if ($post->likes()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'You already liked this post.'], 422);
        }

        // Create a new like
        $like = new Like();
        $like->user_id = $user->id;
        $post->likes()->save($like);

        return $this->sendSuccessResponse(null, 'Post liked successfully.', Response::HTTP_CREATED);
    }

    public function unlike(Post $post): JsonResponse
    {
        $user = auth()->user();

        // Check if the user has liked the post
        $like = $post->likes()->where('user_id', $user->id)->first();

        if (!$like) {
            return response()->json(['message' => 'You have not liked this post.'], 422);
        }

        // Delete the like
        $like->delete();

        return $this->sendSuccessResponse(null, 'Post unliked successfully.', Response::HTTP_OK);
    }
}
