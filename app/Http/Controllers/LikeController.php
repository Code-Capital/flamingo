<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    public function likeOrUnlike(Post $post): JsonResponse
    {
        $user = auth()->user();

        // Check if the user has already liked the post
        $existingLike = $post->likes()->where('user_id', $user->id)->first();

        if ($existingLike) {
            // User has already liked the post, so unlike it
            $existingLike->delete();
        } else {
            // User has not liked the post, so like it
            $post->likes()->create([
                'user_id' => $user->id,
                'is_liked' => true // assuming 'is_liked' is a boolean column
            ]);
        }

        // Retrieve the count of likes for the post
        $response = [
            'likeCount' => $post->load('user')->likes()->count(),
            'post' => $post
        ];

        return $this->sendSuccessResponse($response, 'Post like status updated successfully.', Response::HTTP_OK);
    }
}
