<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function postReport(Request $request, Post $post): JsonResponse
    {
        try {
            $post->reports()->create([
                'user_id' => Auth::id(),
                'reason' => $request->reason,
            ]);

            return $this->sendSuccessResponse(null, 'Post reported successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('An error occurred while reporting the post: '.$th->getMessage());
        }
    }

    public function eventReport(Request $request, Event $event): JsonResponse
    {
        try {
            $event->reports()->create([
                'user_id' => Auth::id(),
                'reason' => $request->reason,
            ]);

            return $this->sendSuccessResponse(null, 'Event reported successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('An error occurred while reporting the post: '.$th->getMessage());
        }
    }

    public function pageReport(Request $request, Page $page): JsonResponse
    {
        try {
            $page->reports()->create([
                'user_id' => Auth::id(),
                'reason' => $request->reason,
            ]);

            return $this->sendSuccessResponse(null, 'Page reported successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('An error occurred while reporting the post: '.$th->getMessage());
        }
    }
}
