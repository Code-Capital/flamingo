<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function addFriend(Request $request, User $user): JsonResponse
    {
        Auth::user()->friends()->attach($user->id);

        return $this->sendSuccessResponse(null, 'Friend request sent successfully', Response::HTTP_CREATED);
    }

    public function statusUpdate(Request $request, User $user): JsonResponse
    {
        $authUser = Auth::user();

        $friend = $authUser->friends()->where('user_id', $user->id)->first();

        if (!$friend) {
            return $this->sendErrorResponse('Friend not found', Response::HTTP_NOT_FOUND);
        }

        $authUser->friends()->updateExistingPivot($user->id, [
            'status' => $request->status,
        ]);

        $message = "Friend request {$request->status} successfully.";

        return $this->sendSuccessResponse(null, $message, Response::HTTP_OK);
    }

    public function removeFriend(Request $request, User $user): JsonResponse
    {
        $request->user()->friends()->detach($user->id);

        return $this->sendSuccessResponse(null, 'Friend removed successfully', Response::HTTP_OK);
    }


    public function gallery(): View
    {
        $user = auth()->user();

        // Get user's own media
        $userMedia = $user->media()->orderBy('created_at', 'desc')->get();

        // Get media from user's posts
        $postMedia = $user->posts()->with('media')->latest()->get()->pluck('media')->flatten();

        // Combine the media collections
        $media = $userMedia->merge($postMedia);

        return view('user.gallery', compact('media'));
    }

    public function uploadMedia(Request $request): JsonResponse
    {
        $request->validate([
            'media' => ['required', 'array'],
            'media.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        $user = auth()->user();
        $mediaFiles = $request->file('media');

        foreach ($mediaFiles as $mediaFile) {
            $mediaPath = $mediaFile->store('media/' . $user->id, 'public');
            $user->media()->create([
                'file_path' => $mediaPath,
                'file_type' => $mediaFile->getClientOriginalExtension(),
            ]);
        }

        $user->notifications()->create([
            'type' => 'post',
            'data' => json_encode([
                'message' => 'Media uploaded',
            ]),
        ]);

        return $this->sendSuccessResponse(null, 'Media uploaded successfully', Response::HTTP_CREATED);
    }
}
