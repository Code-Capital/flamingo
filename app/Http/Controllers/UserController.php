<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function addFriend(Request $request, User $user): JsonResponse
    {
        $request->user()->friends()->attach($user->id);

        return $this->sendSuccessResponse(null, 'Friend added successfully', Response::HTTP_CREATED);
    }

    public function statusUpdate(Request $request, User $user): JsonResponse
    {
        $authUser = $request->user();

        $friend = $authUser->friends()->where('friend_id', $user->id)->first();

        if ($friend) {
            // Update pivot columns
            $authUser->friends()->updateExistingPivot($user->id, [
                'accepted' => $request->input('accepted', $friend->pivot->accepted),
                'rejected' => $request->input('rejected', $friend->pivot->rejected),
                'blocked' => $request->input('blocked', $friend->pivot->blocked),
            ]);
            $accepted = $request->input('accepted', $friend->pivot->accepted);
            $rejected = $request->input('rejected', $friend->pivot->rejected);
            $blocked = $request->input('blocked', $friend->pivot->blocked);

            $message = 'Friend status updated successfully.';
            if ($accepted) {
                $message = 'Friend request accepted successfully.';
            } elseif ($rejected) {
                $message = 'Friend request rejected successfully.';
            } elseif ($blocked) {
                $message = 'Friend blocked successfully.';
            }

            return $this->sendSuccessResponse(null, $message, Response::HTTP_OK);
        }

        return $this->sendErrorResponse('Friend not found', Response::HTTP_NOT_FOUND);
    }

    public function removeFriend(Request $request, User $user): JsonResponse
    {
        $request->user()->friends()->detach($user->id);

        return $this->sendSuccessResponse(null, 'Friend removed successfully', Response::HTTP_OK);
    }

    public function acceptFriend(Request $request, User $user): JsonResponse
    {
        try {
            $request->user()->friends()->updateExistingPivot($user->id, ['accepted' => true]);

            return $this->sendSuccessResponse(null, 'Friend request accepted successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->sendErrorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
