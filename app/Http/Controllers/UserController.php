<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Chatify\CustomChatify;
use App\Events\FriendRequestSend;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Enums\NotificationStatusEnum;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public $customChatify;

    public function __construct(CustomChatify $customChatify)
    {
        $this->customChatify = $customChatify;
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

        return view('user.gallery', get_defined_vars());
    }

    public function addFriend(Request $request, User $user): JsonResponse
    {

        $user->friends()->attach($request->user()->id, [
            'status' => 'pending',
        ]);

        broadcast(new FriendRequestSend($user, $request->user()));

        return $this->sendSuccessResponse(null, 'Friend request sent successfully', Response::HTTP_CREATED);
    }

    public function statusUpdate(Request $request, User $user): JsonResponse
    {
        $authUser = Auth::user();

        $friend = $authUser->friends()->where('user_id', $user->id)->first();

        if (! $friend) {
            return $this->sendErrorResponse('Friend not found', Response::HTTP_NOT_FOUND);
        }
        try {
            DB::transaction(function () use ($user, $authUser, $request) {
                $authUser->friends()->updateExistingPivot($user->id, [
                    'status' => $request->status,
                ]);

                if ($request->status == StatusEnum::ACCEPTED->value) {
                    $user->friends()->attach($authUser->id, [
                        'status' => $request->status,
                    ]);

                    $response = $this->customChatify->getOrCreateChannel($user->id);

                    if ($response && $response->channel_id) {
                        $this->customChatify->newMessage([
                            'from_id' => $authUser->id,
                            'to_channel_id' => $response->channel_id,
                            'body' => $user->user_name . __(' accepted your friend request'),
                            'attachment' => null,
                        ]);
                    }

                    $user->notifications()->create([
                        'type' => NotificationStatusEnum::FRIENDREQUESTACCEPTED->value,
                        'data' => json_encode([
                            'message' => __(':user_name accepted your friend request', [
                                'user_name' => $authUser->user_name,
                            ]),
                            'user_id' => $authUser->id,
                            'user_name' => $authUser->user_name,
                        ]),
                    ]);
                }

                if ($request->status == StatusEnum::BLOCKED->value) {
                    $user->friends()->detach($authUser->id);
                }
            });
            $message = "Friend request {$request->status} successfully.";
            return $this->sendSuccessResponse(null, $message, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Something went wrong' . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
        $media = [];

        foreach ($mediaFiles as $mediaFile) {
            $mediaPath = $mediaFile->store('media/' . $user->id, 'public');
            $media[] = $user->media()->create([
                'file_path' => $mediaPath,
                'file_type' => $mediaFile->getClientOriginalExtension(),
            ]);
        }

        $link = route('gallery');
        $message = "<div class='notification'>
                            <a href='{$link}' target='_blank'>
                                Your media files have been uploaded successfully
                            </a>
                        </div>
                    ";

        $user->notifications()->create([
            'type' => NotificationStatusEnum::MEDIAUPLOADED->value,
            'data' => json_encode([
                'message' => $message,
                'media_paths' => json_encode($media),
            ]),
        ]);

        return $this->sendSuccessResponse(null, 'Media uploaded successfully', Response::HTTP_CREATED);
    }

    public function peopleWithSameInterest(): View
    {
        $user = Auth::user();

        $peoples = getPeoples($user, limit: 10, pagination: true);

        return view('user.people-with-same-interest', get_defined_vars());
    }
}
