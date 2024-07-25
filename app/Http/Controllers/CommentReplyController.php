<?php

namespace App\Http\Controllers;

use App\Enums\CommentTypeEnum;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CommentReplyController extends Controller
{
    public function store(Request $request, Comment $comment): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'body' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors()->first(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create a new comment
        $comment = $comment->replies()->create([
            'body' => $request->body,
            'type' => CommentTypeEnum::REPLY->value,
            'user_id' => auth()->id(),
        ]);

        // Load specific columns for user and post, and load count of likes
        $comment = $comment->load(['user', 'post' => function ($query) {
            return $query->select('id', 'body');
        }])->loadCount('likes');

        // Return the response with the combined data object
        return $this->sendSuccessResponse($comment, 'Comment Posted', Response::HTTP_CREATED);
    }
}
