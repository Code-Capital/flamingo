<?php

namespace App\Http\Controllers\vendor\Chatify;

use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Chatify\CustomChatify;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Models\ChChannel as Channel;
use App\Models\ChMessage as Message;
use Illuminate\Support\Facades\Auth;
use App\Models\ChFavorite as Favorite;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Response;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Request as FacadesRequest;

class MessagesController extends Controller
{
    protected $perPage = 30;
    protected $customChatify;

    public function __construct()
    {
        $this->customChatify = new CustomChatify();
    }

    /**
     * Authenticate the connection for pusher
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function pusherAuth(Request $request)
    {
        return $this->customChatify->pusherAuth(
            $request->user(),
            Auth::user(),
            $request['channel_name'],
            $request['socket_id']
        );
    }

    /**
     * Returning the view of the app with the required data.
     *
     * @param string $channel_id
     * @return Application|Factory|View
     */
    public function index(Request $request, $channel_id = null)
    {
        $user = Auth::user();
        if (!$user->isSubscribed()) {
            // abort(403, "You need to subscribe to access this page.");
            return to_route('pricing');
        }

        $messenger_color = $user->messenger_color;

        if (!$user->channel_id) {
            $this->customChatify->createPersonalChannel();
        }

        return view('Chatify::pages.app', [
            'channel_id' => $channel_id ?? 0,
            'channel' => $channel_id ? Channel::where('id', $channel_id)->first() : null,
            'messengerColor' => $messenger_color ? $messenger_color : Chatify::getFallbackColor(),
            'dark_mode' => $user->dark_mode < 1 ? 'light' : 'dark',
        ]);
    }

    /**
     * Fetch data (user, favorite.. etc).
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function idFetchData(Request $request)
    {
        $fetch = null;
        $channel_avatar = null;

        $favorite = Chatify::inFavorite($request['channel_id']);
        $channel = Channel::find($request['channel_id']);

        if (!$channel) return Response::json([
            'message' => "This chat channel doesn't exist!"
        ]);

        $allow_loading = $channel->owner_id === Auth::user()->id
            || in_array(Auth::user()->id, $channel->users()->pluck('id')->all());
        if (!$allow_loading) return Response::json([
            'message' => "You haven't joined this chat channel!"
        ]);

        // check if this channel is a group
        if (isset($channel->owner_id)) {
            $fetch = $channel;
            $channel_avatar = $this->customChatify->getChannelWithAvatar($channel)->avatar;
        } else {
            $fetch = $this->customChatify->getUserInOneChannel($request['channel_id']);
            if ($fetch) {
                $channel_avatar = $this->customChatify->getUserWithAvatar($fetch)->avatar;
            }
        }

        $infoHtml = view('Chatify::layouts.info', [
            'channel' => $channel,
        ])->render();

        return Response::json([
            'infoHtml' => $infoHtml,
            'favorite' => $favorite,
            'fetch' => $fetch ?? null,
            'channel_avatar' => $channel_avatar ?? null,
        ]);
    }

    /**
     * This method to make a links for the attachments
     * to be downloadable.
     *
     * @param string $fileName
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|void
     */
    public function download($fileName)
    {
        $filePath = config('chatify.attachments.folder') . '/' . $fileName;
        if (Chatify::storage()->exists($filePath)) {
            return Chatify::storage()->download($filePath);
        }
        return abort(404, "Sorry, File does not exist in our server or may have been deleted!");
    }

    /**
     * Send a message to database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function send(Request $request)
    {
        // default variables
        $error = (object)[
            'status' => 0,
            'message' => null
        ];
        $attachment = null;
        $attachment_title = null;
        $user = Auth::user();

        // if there is attachment [file]
        if ($request->hasFile('file')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();
            $allowed_files  = Chatify::getAllowedFiles();
            $allowed        = array_merge($allowed_images, $allowed_files);

            $file = $request->file('file');
            // check file size
            if ($file->getSize() < Chatify::getMaxUploadSize()) {
                if (in_array(strtolower($file->extension()), $allowed)) {
                    // get attachment name
                    $attachment_title = $file->getClientOriginalName();
                    // upload attachment and store the new name
                    $attachment = Str::uuid() . "." . $file->extension();
                    $file->storeAs(config('chatify.attachments.folder'), $attachment, config('chatify.storage_disk_name'));
                } else {
                    $error->status = 1;
                    $error->message = "File extension not allowed!";
                }
            } else {
                $error->status = 1;
                $error->message = "File size you are trying to upload is too large!";
            }
        }

        if (!$error->status) {
            $lastMess = Message::where('to_channel_id', $request['channel_id'])->latest()->first();
            $message = Chatify::newMessage([
                'from_id' => $user->id,
                'to_channel_id' => $request['channel_id'],
                'body' => htmlentities(trim($request['message']), ENT_QUOTES, 'UTF-8'),
                'attachment' => ($attachment) ? json_encode((object)[
                    'new_name' => $attachment,
                    'old_name' => htmlentities(trim($attachment_title), ENT_QUOTES, 'UTF-8'),
                ]) : null,
            ]);

            // load user infol;
            $message->user_avatar = $user->avatar;
            $message->user_name = $user->user_name;
            $message->user_email = $user->email;

            $messageData = Chatify::parseMessage($message, null, $lastMess ? $lastMess->from_id !== $user->id : true);

            Chatify::push("private-chatify." . $request['channel_id'], 'messaging', [
                'from_id' => $user->id,
                'to_channel_id' => $request['channel_id'],
                'message' => Chatify::messageCard($messageData, true)
            ]);
        }

        // send the response
        return Response::json([
            'status' => '200',
            'error' => $error,
            'message' => Chatify::messageCard(@$messageData),
            'tempID' => $request['temporaryMsgId'],
        ]);
    }

    /**
     * fetch [user/group] messages from database
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function fetch(Request $request)
    {
        $query = $this->customChatify->fetchMessagesQuery($request['id'])->latest();
        $messages = $query->paginate($request->per_page ?? $this->perPage);
        $totalMessages = $messages->total();
        $lastPage = $messages->lastPage();
        $response = [
            'total' => $totalMessages,
            'last_page' => $lastPage,
            'last_message_id' => collect($messages->items())->last()->id ?? null,
            'messages' => '',
        ];

        // if there is no messages yet.
        if ($totalMessages < 1) {
            $response['messages'] = '<p class="message-hint center-el"><span>Say \'hi\' and start messaging</span></p>';
            return Response::json($response);
        }
        if (count($messages->items()) < 1) {
            $response['messages'] = '';
            return Response::json($response);
        }
        $allMessages = null;
        $prevMess = null;
        foreach ($messages->reverse() as $message) {
            $allMessages .= $this->customChatify->messageCard(
                $this->customChatify->parseMessage($message, null, $prevMess ? $prevMess->from_id != $message->from_id : true)
            );
            $prevMess = $message;
        }
        $response['messages'] = $allMessages;
        return Response::json($response);
    }

    /**
     * Make messages as seen
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function seen(Request $request)
    {
        // make as seen
        $seen = $this->customChatify->makeSeen($request['channel_id']);
        // send the response
        return Response::json([
            'status' => $seen,
        ], 200);
    }

    /**
     * Get contacts list (list of channels)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getContacts(Request $request)
    {
        // $query = Channel::join('ch_messages', 'ch_channels.id', '=', 'ch_messages.to_channel_id')
        //     ->join('ch_channel_user', 'ch_channels.id', '=', 'ch_channel_user.channel_id')
        //     ->where('ch_channel_user.user_id', '=', Auth::user()->id)
        //     ->select('ch_channels.*', DB::raw('ch_messages.created_at messaged_at'))
        //     ->groupBy('ch_channels.id')
        //     ->orderBy('messaged_at', 'desc')
        //     ->paginate($request->per_page ?? $this->perPage);

        // $query = Channel::join('ch_messages', function ($join) {
        //     $join->on('ch_messages.to_channel_id', '=', 'ch_channels.id');
        // })
        //     ->join('ch_channel_user', function ($join) {
        //         $join->on('ch_channel_user.channel_id', '=', 'ch_channels.id');
        //         // Ensure user is part of the channel (assuming a foreign key):
        //         $join->where('ch_channel_user.user_id', '=', Auth::user()->id);
        //     })
        //     ->select([
        //         'ch_channels.*',
        //         DB::raw('MAX(ch_messages.created_at) AS messaged_at'), // Get latest message for each channel
        //     ])
        //     ->groupBy('ch_channels.id')
        //     ->orderBy('messaged_at', 'desc')
        //     ->paginate($request->per_page ?? $this->perPage);



        $query = Channel::join('ch_messages', function ($join) {
            $join->on('ch_messages.to_channel_id', '=', 'ch_channels.id');
        })
            ->join('ch_channel_user', function ($join) {
                $join->on('ch_channel_user.channel_id', '=', 'ch_channels.id');
                $join->where('ch_channel_user.user_id', '=', Auth::user()->id);
            })
            ->select([
                'ch_channels.id',  // Select specific columns from ch_channels
                'ch_channels.name',
                'ch_channels.owner_id', // Add more columns as needed
                'ch_channels.avatar', // Add more columns as needed
                DB::raw('MAX(ch_messages.created_at) AS messaged_at') // Aggregate function
            ])
            ->groupBy('ch_channels.id', 'ch_channels.name', 'ch_channels.owner_id', 'ch_channels.avatar') // Group by all non-aggregate columns
            ->orderBy('messaged_at', 'desc')
            ->paginate($request->per_page ?? $this->perPage);



        // $query = Channel::join('ch_messages', function ($join) {
        //     $join->on('ch_messages.to_channel_id', '=', 'ch_channels.id');
        // })
        // ->join('ch_channel_user', function ($join) {
        //     $join->on('ch_channel_user.channel_id', '=', 'ch_channels.id');
        //     $join->where('ch_channel_user.user_id', '=', Auth::user()->id);
        // })
        // ->select([
        //     'ch_channels.id',
        //     'ch_channels.name', // Add any other columns from ch_channels that you need
        //     DB::raw('MAX(ch_messages.created_at) AS messaged_at') // Get latest message date
        // ])
        // ->groupBy('ch_channels.id', 'ch_channels.name') // Include all selected columns in GROUP BY
        // ->orderBy('messaged_at', 'desc')
        // ->paginate($request->per_page ?? $this->perPage);


        $channelsList = $query->items();

        if (count($channelsList) > 0) {
            $contacts = '';
            foreach ($channelsList as $channel) {
                $contacts .= $this->customChatify->getContactItem($channel);
            }
        } else {
            $contacts = '<p class="message-hint center-el"><span>Your contact list is empty</span></p>';
        }

        return Response::json([
            'contacts' => $contacts,
            'total' => $query->total() ?? 0,
            'last_page' => $query->lastPage() ?? 1,
        ], 200);
    }



    /**
     * Update user's list item data
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateContactItem(Request $request)
    {
        $channel_id = $request['channel_id'];

        // Get user data
        $channel = Channel::find($channel_id);
        if (!$channel) {
            return Response::json([
                'message' => 'Channel not found!',
            ], 401);
        }
        $contactItem = $this->customChatify->getContactItem($channel);

        // send the response
        return Response::json([
            'contactItem' => $contactItem,
        ], 200);
    }

    /**
     * Get channel_id by get or create new channel
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function getChannelId(Request $request)
    {
        $user_id = $request['user_id'];
        $res = Chatify::getOrCreateChannel($user_id);

        // send the response
        return Response::json($res, 200);
    }

    /**
     * Put a channel in the favorites list
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function favorite(Request $request)
    {
        $channel_id = $request['channel_id'];
        // check action [star/unstar]
        $favoriteStatus = Chatify::inFavorite($channel_id) ? 0 : 1;
        Chatify::makeInFavorite($channel_id, $favoriteStatus);

        // send the response
        return Response::json([
            'status' => @$favoriteStatus,
        ], 200);
    }

    /**
     * Get favorites list
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function getFavorites(Request $request)
    {
        $favoritesList = null;
        $favorites = Favorite::where('user_id', Auth::user()->id);
        foreach ($favorites->get() as $favorite) {
            $channel = Channel::find($favorite->favorite_id);

            $data = null;
            if ($channel->owner_id) {
                $data = Chatify::getChannelWithAvatar($channel);
            } else {
                $user = Chatify::getUserInOneChannel($channel->id);
                $data = Chatify::getUserWithAvatar($user);
            }
            $favoritesList .= view('Chatify::layouts.favorite', [
                'data' => $data,
                'channel_id' => $channel->id
            ]);
        }
        // send the response
        return Response::json([
            'count' => $favorites->count(),
            'favorites' => $favorites->count() > 0
                ? $favoritesList
                : 0,
        ], 200);
    }

    /**
     * Search in messenger
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function search(Request $request)
    {
        $getRecords = null;
        $input = trim(filter_var($request['input']));
        $records = User::where('id', '!=', Auth::user()->id)
            ->where(function ($query) use ($input) {
                $query->where('first_name', 'LIKE', "%{$input}%")
                    ->orWhere('user_name', 'LIKE', "%{$input}%")
                    ->orWhere('last_name', 'LIKE', "%{$input}%");
            })
            ->paginate($request->per_page ?? $this->perPage);

        foreach ($records->items() as $record) {
            $getRecords .= view('Chatify::layouts.listItem', [
                'get' => 'search_item',
                'user' => $this->customChatify->getUserWithAvatar($record),
            ])->render();
        }
        if ($records->total() < 1) {
            $getRecords = '<p class="message-hint center-el"><span>Nothing to show.</span></p>';
        }
        // send the response
        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }

    /**
     * Get shared photos
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function sharedPhotos(Request $request)
    {
        $shared = $this->customChatify->getSharedPhotos($request['channel_id']);
        $sharedPhotos = null;

        // shared with its template
        for ($i = 0; $i < count($shared); $i++) {
            $sharedPhotos .= view('Chatify::layouts.listItem', [
                'get' => 'sharedPhoto',
                'image' => Chatify::getAttachmentUrl($shared[$i]),
            ])->render();
        }
        // send the response
        return Response::json([
            'shared' => count($shared) > 0 ? $sharedPhotos : '<p class="message-hint"><span>Nothing shared yet</span></p>',
        ], 200);
    }

    /**
     * Delete conversation
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteConversation(Request $request)
    {
        // delete
        $delete = Chatify::deleteConversation($request['channel_id']);

        // send the response
        return Response::json([
            'deleted' => $delete ? 1 : 0,
        ], 200);
    }

    /**
     * Delete group chat
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteGroupChat(Request $request)
    {
        $channel_id = $request['channel_id'];


        $channel = Channel::findOrFail($channel_id);
        $channel->users()->detach();

        Chatify::deleteConversation($channel_id);


        // send the response
        return Response::json([
            'deleted' => $channel->delete(),
        ], 200);
    }

    /**
     * Leave group chat
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function leaveGroupChat(Request $request)
    {
        $channel_id = $request['channel_id'];
        $user_id = $request['user_id'];

        // add last message
        $user = Auth::user();
        $message = Chatify::newMessage([
            'from_id' => $user->id,
            'to_channel_id' => $channel_id,
            'body' => $user->user_name . ' has left the group',
            'attachment' => null,
        ]);
        $message->user_avatar = $user->avatar;
        $message->user_name = $user->user_name;
        $message->user_email = $user->email;

        $messageData = Chatify::parseMessage($message, null);

        Chatify::push("private-chatify." . $channel_id, 'messaging', [
            'from_id' => $user->id,
            'to_channel_id' => $channel_id,
            'message' => Chatify::messageCard($messageData, true)
        ]);

        // detach user
        $channel = Channel::findOrFail($channel_id);
        $channel->users()->detach($user_id);

        // send the response
        return Response::json([
            'left' => $channel ? 1 : 0,
        ], 200);
    }

    /**
     * Delete message
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteMessage(Request $request)
    {
        // delete
        $delete = Chatify::deleteMessage($request['id']);

        // send the response
        return Response::json([
            'deleted' => $delete ? 1 : 0,
        ], 200);
    }

    public function updateSettings(Request $request)
    {
        $msg = null;
        $error = $success = 0;

        // dark mode
        if ($request['dark_mode']) {
            $request['dark_mode'] == "dark"
                ? User::where('id', Auth::user()->id)->update(['dark_mode' => 1])  // Make Dark
                : User::where('id', Auth::user()->id)->update(['dark_mode' => 0]); // Make Light
        }

        // If messenger color selected
        if ($request['messengerColor']) {
            $messenger_color = trim(filter_var($request['messengerColor']));
            User::where('id', Auth::user()->id)
                ->update(['messenger_color' => $messenger_color]);
        }
        // if there is a [file]
        if ($request->hasFile('avatar')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();

            $file = $request->file('avatar');
            // check file size
            if ($file->getSize() < Chatify::getMaxUploadSize()) {
                if (in_array(strtolower($file->extension()), $allowed_images)) {
                    // delete the older one
                    if (Auth::user()->avatar != config('chatify.user_avatar.default')) {
                        $avatar = Auth::user()->avatar;
                        if (Chatify::storage()->exists($avatar)) {
                            Chatify::storage()->delete($avatar);
                        }
                    }
                    // upload
                    $avatar = Str::uuid() . "." . $file->extension();
                    $update = User::where('id', Auth::user()->id)->update(['avatar' => $avatar]);
                    $file->storeAs(config('chatify.user_avatar.folder'), $avatar, config('chatify.storage_disk_name'));
                    $success = $update ? 1 : 0;
                } else {
                    $msg = "File extension not allowed!";
                    $error = 1;
                }
            } else {
                $msg = "File size you are trying to upload is too large!";
                $error = 1;
            }
        }

        // send the response
        return Response::json([
            'status' => $success ? 1 : 0,
            'error' => $error ? 1 : 0,
            'message' => $error ? $msg : 0,
        ], 200);
    }

    /**
     * Set user's active status
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function setActiveStatus(Request $request)
    {
        $activeStatus = $request['status'] > 0 ? 1 : 0;
        $status = User::where('id', Auth::user()->id)->update(['active_status' => $activeStatus]);
        return Response::json([
            'status' => $status,
        ], 200);
    }

    /**
     * Search users
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function searchUsers(Request $request)
    {

        $getRecords = array();
        $input = trim(filter_var($request['input']));

        $records = User::where('id', '!=', Auth::user()->id)
            ->where(function ($query) use ($input) {
                $query->where('first_name', 'LIKE', "%{$input}%")
                    ->orWhere('user_name', 'LIKE', "%{$input}%")
                    ->orWhere('last_name', 'LIKE', "%{$input}%");
            })
            ->paginate($request->per_page ?? $this->perPage);


        foreach ($records->items() as $record) {
            $getRecords[] = array(
                "user" => $record,
                "view" => view('Chatify::layouts.listItem', [
                    'get' => 'user_search_item',
                    'user' => Chatify::getUserWithAvatar($record),
                ])->render()
            );
        }
        if ($records->total() < 1) {
            $getRecords = '<p class="message-hint"><span>Nothing to show.</span></p>';
        }
        // send the response
        return Response::json([
            'records' => $getRecords,
            'total' => $records->total(),
            'last_page' => $records->lastPage()
        ], 200);
    }


    public function createGroupChat(Request $request)
    {
        $msg = null;
        $error = $success = 0;

        $user = Auth::user();
        $user_ids = array_map('intval', explode(',', $request['user_ids'])) ?? [];
        $user_ids[] = $user->id;

        $group_name = $request['group_name'];

        $new_channel = new Channel();
        $new_channel->name = $group_name;
        $new_channel->owner_id = $user->id;
        $new_channel->save();
        $new_channel->users()->sync($user_ids);

        // add first message
        $message = Chatify::newMessage([
            'from_id' => $user->id,
            'to_channel_id' => $new_channel->id,
            'body' => $user->user_name . __(' has created a new chat group') . ': ' . $group_name,
            'attachment' => null,
        ]);
        $message->user_name = $user->user_name;
        $message->user_email = $user->email;

        $messageData = Chatify::parseMessage($message, null);
        Chatify::push("private-chatify." . $new_channel->id, 'messaging', [
            'from_id' => $user->id,
            'to_channel_id' => $new_channel->id,
            'message' => Chatify::messageCard($messageData, true)
        ]);


        // if there is a [file]
        if ($request->hasFile('avatar')) {
            // allowed extensions
            $allowed_images = Chatify::getAllowedImages();

            $file = $request->file('avatar');
            // check file size
            if ($file->getSize() < Chatify::getMaxUploadSize()) {
                if (in_array(strtolower($file->extension()), $allowed_images)) {
                    $avatar = Str::uuid() . "." . $file->extension();
                    $update = $new_channel->update(['avatar' => $avatar]);
                    $file->storeAs(config('chatify.channel_avatar.folder'), $avatar, config('chatify.storage_disk_name'));
                    $success = $update ? 1 : 0;
                } else {
                    $msg = "File extension not allowed!";
                    $error = 1;
                }
            } else {
                $msg = "File size you are trying to upload is too large!";
                $error = 1;
            }
        }

        return Response::json([
            'status' => $success ? 1 : 0,
            'error' => $error ? 1 : 0,
            'message' => $error ? $msg : 0,
            'channel' => $new_channel
        ], 200);
    }

    public function joinChat(Request $request, Page $page)
    {
        // Get the list of user IDs associated with the channel
        $userIds = $page->acceptedUsers()->pluck('user_id')->toArray();
        $userIds[] = $page->user_id; // Add the page owner's user ID

        // Find the channel or fail if not found
        $channel = Channel::findOrFail($page->channel_id);

        // Get the authenticated user
        $user = Auth::user();

        // Create a dynamic channel name based on the channel and user info
        $channelName = $channel->name . ' - ' . $user->id . ' ' . $user->user_name;
        $avatar = $this->customChatify->createGravatarChannelAvatar($channelName);

        // Call the custom Chatify method to create the group chat
        $response = $this->customChatify->createGroupChat(
            request: $request,
            groupName: $channelName,
            userIds: $userIds,
            avatar: $avatar
        );

        // Access the response content (JSON format) and decode it into an array
        $responseData = $response->getData(true); // Convert JSON response to an associative array

        // Extract the 'channel_id' from the decoded JSON response
        $channelId = $responseData['channel']['id'] ?? null; // Safely access 'channel' and 'id'

        // If channel_id is found, redirect to the desired route
        if ($channelId) {
            return redirect()->route('channel_id', ['channel_id' => $channelId]);
        }

        // Handle case if channel_id is not found (optional)
        return back()->withErrors(['error' => 'Channel creation failed.']);
    }
}
