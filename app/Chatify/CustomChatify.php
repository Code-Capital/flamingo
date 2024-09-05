<?php

namespace App\Chatify;

use Exception;
use App\Models\User;
use Chatify\ChatifyMessenger;
use Illuminate\Support\Facades\Log;
use App\Models\ChChannel as Channel;
use App\Models\ChMessage as Message;
use Illuminate\Support\Facades\Auth;
use App\Models\ChFavorite as Favorite;
use Illuminate\Support\Facades\Storage;

class CustomChatify extends ChatifyMessenger
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create Personal Channel
     *
     * @return string
     */
    public function createPersonalChannel()
    {
        $new_channel = new Channel();
        $new_channel->save();

        $user = Auth::user();
        $new_channel->users()->sync([$user->id]);
        $user->channel_id = $new_channel->id;
        $user->save();

        return $new_channel->id;
    }

    /**
     * Get user list's item data [Contact Item]
     * (e.g. User data, Last message, Unseen Counter...)
     *
     * @param int $messenger_id
     * @param Collection $channel
     * @return string
     */
    public function getContactItem($channel)
    {
        if ($channel->id == Auth::user()->channel_id) return ''; // myself channel | saved messages

        try {
            $lastMessage = $this->getLastMessageQuery($channel->id);
            $unseenCounter = $this->countUnseenMessages($channel->id);
            if ($lastMessage) {
                $lastMessage->created_at = $lastMessage->created_at->toIso8601String();
                $lastMessage->timeAgo = $lastMessage->created_at->diffForHumans();
            }

            // check if this channel is a group
            if (isset($channel->owner_id)) {
                return view('Chatify::layouts.listItem', [
                    'get' => 'contact-group',
                    'channel' => $this->getChannelWithAvatar($channel),
                    'lastMessage' => $lastMessage,
                    'unseenCounter' => $unseenCounter,
                ])->render();
            } else {
                $user = $this->getUserInOneChannel($channel->id);

                return view('Chatify::layouts.listItem', [
                    'get' => 'contact-user',
                    'channel' => $channel,
                    'user' => $this->getUserWithAvatar($user),
                    'lastMessage' => $lastMessage,
                    'unseenCounter' => $unseenCounter,
                ])->render();
            }
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    /**
     * Get last message for a specific user
     *
     * @param string $channel_id
     * @return Message|Collection|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getLastMessageQuery($channel_id)
    {
        return $this->fetchMessagesQuery($channel_id)->latest()->first();
    }

    /**
     * Default fetch messages query between a Sender and Receiver.
     *
     * @param string $channel_id
     * @return Message|\Illuminate\Database\Eloquent\Builder
     */
    public function fetchMessagesQuery($channel_id)
    {
        return Message::where('to_channel_id', $channel_id)
            ->join('users', 'ch_messages.from_id', 'users.id')
            // load user info
            ->select('ch_messages.*', 'users.user_name as user_name', 'users.email as user_email', 'users.id as user_id', 'users.avatar as user_avatar');
    }

    /**
     * Get user with avatar (formatted).
     *
     * @param Collection $user
     * @return Collection
     */
    public function getUserWithAvatar($user)
    {
        if ($user->avatar == config('chatify.user_avatar.default') && config('chatify.gravatar.enabled')) {
            $imageSize = config('chatify.gravatar.image_size');
            $imageset = config('chatify.gravatar.imageset');
            $user->avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=' . $imageSize . '&d=' . $imageset;
        } else {
            $user->avatar = self::getUserAvatarUrl($user->avatar);
        }
        return $user;
    }

    /**
     * Get user with avatar (formatted).
     *
     * @param Collection $channel
     * @return Collection
     */
    public function getChannelWithAvatar($channel)
    {
        if ($channel->avatar == config('chatify.user_avatar.default') && config('chatify.gravatar.enabled')) {
            $imageSize = config('chatify.gravatar.image_size');
            $imageset = config('chatify.gravatar.imageset');
            $channel->avatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($channel->name))) . '?s=' . $imageSize . '&d=' . $imageset;
        } else {
            $channel->avatar = self::getChannelAvatarUrl($channel->avatar);
        }
        return $channel;
    }

    /**
     * Get user avatar url.
     *
     * @param string $user_avatar_name
     * @return string
     */
    public function getUserAvatarUrl($user_avatar_name)
    {
        return Storage::url(config('chatify.user_avatar.folder') . '/' . $user_avatar_name);
    }

    /**
     * Get attachment's url.
     *
     * @param string $attachment_name
     * @return string
     */
    public function getAttachmentUrl($attachment_name)
    {
        return Storage::url(config('chatify.attachments.folder') . '/' . $attachment_name);
    }

    /**
     * Get shared photos of the conversation
     *
     * @param string $channel_id
     * @return array
     */
    public function getSharedPhotos($channel_id)
    {
        $images = array(); // Default
        // Get messages
        $msgs = $this->fetchMessagesQuery($channel_id)->orderBy('created_at', 'DESC');
        if ($msgs->count() > 0) {
            foreach ($msgs->get() as $msg) {
                // If message has attachment
                if ($msg->attachment) {
                    $attachment = json_decode($msg->attachment);
                    // determine the type of the attachment
                    in_array(pathinfo($attachment->new_name, PATHINFO_EXTENSION), $this->getAllowedImages())
                        ? array_push($images, $attachment->new_name) : '';
                }
            }
        }
        return $images;
    }

    /**
     * Delete Conversation
     *
     * @param string $channel_id
     * @return boolean
     */
    public function deleteConversation($channel_id)
    {
        try {
            foreach ($this->fetchMessagesQuery($channel_id)->get() as $msg) {
                // delete file attached if exist
                if (isset($msg->attachment)) {
                    $path = config('chatify.attachments.folder') . '/' . json_decode($msg->attachment)->new_name;
                    if (self::storage()->exists($path)) {
                        self::storage()->delete($path);
                    }
                }
                // delete from database
                $msg->delete();
            }
            return 1;
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return 0;
        }
    }

    /**
     * Check if a channel in the favorite list
     *
     * @param string $channel_id
     * @return boolean
     */
    public function inFavorite($channel_id)
    {
        return Favorite::where('user_id', Auth::user()->id)
            ->where('favorite_id', $channel_id)->count() > 0;
    }

    /**
     * Get user in on channel
     *
     * @param string $channel_id
     * @return Collection
     */
    public function getUserInOneChannel(string $channel_id)
    {
        if ($channel_id == Auth::user()->channel_id) return Auth::user();

        return User::where('id', '!=', Auth::user()->id)
            ->join('ch_channel_user', 'users.id', '=', 'ch_channel_user.user_id')
            ->where('ch_channel_user.channel_id', $channel_id)
            ->select('users.*')
            ->first();
    }

    /**
     * Count Unseen messages
     *
     * @param string $channel_id
     * @return numeric
     */
    public function countUnseenMessages(string $channel_id)
    {
        $auth_id = Auth::user()->id;
        return Message::where('to_channel_id', $channel_id)
            ->where('from_id', '<>', $auth_id)
            ->where(function ($query) use ($auth_id) {
                $query
                    // ->whereJsonDoesntContain('seen', $auth_id)
                    ->orWhereNull('seen');
            })
            ->count();
    }


    /**
     * Make messages between the sender [Auth user] and
     * the receiver [User id] as seen.
     *
     * @param string $channel_id
     * @return bool
     */
    public function makeSeen($channel_id)
    {
        $auth_id = Auth::user()->id;
        $messages = Message::where('to_channel_id', $channel_id)
            ->where('from_id', '<>', $auth_id)
            ->where(function ($query) use ($auth_id) {
                $query
                    ->where('seen', 'NOT LIKE', "%,$auth_id,%")
                    // ->whereJsonDoesntContain('seen', $auth_id)
                    ->orWhereNull('seen');
            })
            ->get();

        foreach ($messages as $mess) {
            $mess->seen = !$mess->seen ? array($auth_id) : array_merge($mess->seen, array($auth_id));
            $mess->save();
        }

        return 1;
    }
}
