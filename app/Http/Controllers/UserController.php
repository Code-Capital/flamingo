<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function gallery(): View
    {
        $user = auth()->user();

        // Get user's own media
        $userMedia = $user->media()->orderBy('created_at', 'desc')->get();

        // Get media from user's posts
        $postMedia = $user->posts()->with('media')->latest()->get()->pluck('media')->flatten();

        // Combine the media collections
        $media = $userMedia->merge($postMedia);

        return view('user.gallery', get_defined_vars());
    }

    public function addFriend(Request $request, User $user): JsonResponse
    {

        $user->friends()->attach($request->user()->id, [
            'status' => 'pending',
        ]);

        return $this->sendSuccessResponse(null, 'Friend request sent successfully', Response::HTTP_CREATED);
    }

    public function statusUpdate(Request $request, User $user): JsonResponse
    {
        $authUser = Auth::user();

        $friend = $authUser->friends()->where('user_id', $user->id)->first();

        if (! $friend) {
            return $this->sendErrorResponse('Friend not found', Response::HTTP_NOT_FOUND);
        }

        $authUser->friends()->updateExistingPivot($user->id, [
            'status' => $request->status,
        ]);

        if ($request->status == StatusEnum::ACCEPTED->value) {
            $user->friends()->attach($authUser->id, [
                'status' => $request->status,
            ]);
        }

        if ($request->status == StatusEnum::BLOCKED->value) {
            $user->friends()->detach($authUser->id);
        }

        $message = "Friend request {$request->status} successfully.";

        return $this->sendSuccessResponse(null, $message, Response::HTTP_OK);
    }

    public function removeFriend(Request $request, User $user): JsonResponse
    {
        $authUser = Auth::user();
        $authUser->friends()->detach($user->id);
        $user->friends()->detach($authUser->id);

        return $this->sendSuccessResponse(null, 'Friend removed successfully', Response::HTTP_OK);
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
            $mediaPath = $mediaFile->store('media/'.$user->id, 'public');
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

    public function peopleWithSameInterest(): View
    {
        $user = Auth::user();
        $peoples = $user->byInterests($user->interests->pluck('id')->toArray())
            ->byNotUser($user->id)
            ->limit(10)
            ->paginate(getPaginated());

        return view('user.people-with-same-interest', get_defined_vars());
    }
}
