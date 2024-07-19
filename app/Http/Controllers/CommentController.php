<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Enums\CommentTypeEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors()->first(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Create a new comment
        $comment = $post->comments()->create([
            'body' => $request->body,
            'type' => CommentTypeEnum::COMMENT,
            'user_id' => auth()->id(),
        ]);

        // Load specific columns for user and post, and load count of likes
        $comment->load(['user', 'post' => function ($query) {
            return $query->select('id', 'body');
        }])->loadCount('likes');

        // Retrieve the current count of comments for the post
        $currentCommentCount = $post->comments()->count();

        // Package comment details and current comment count into a single data object
        $responseData = [
            'comment' => $comment,
            'current_comment_count' => $currentCommentCount,
        ];

        // Return the response with the combined data object
        return $this->sendSuccessResponse($responseData, 'Comment Posted', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
