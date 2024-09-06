<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FriendRequestSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $receiver;
    public $sender;
    /**
     * Create a new event instance.
     */
    public function __construct(User $receiver, $sender)
    {
        $this->receiver = $receiver;
        $this->sender = $sender;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        Log::info('FRIEND REQUEST EVENT CHANNEL NAME -> notification.' . $this->receiver->id);
        return [
            new Channel('notification.' . $this->receiver->id),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs(): string
    {
        return 'notification-created';
    }


    /**
     * Get the data to broadcast with the event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        // Generate the link to the post
        $link = route('profile.info');

        // Create the HTML message
        $message = "
            <div class='notification'>
                    {$this->sender->full_name} send you a friend Request <a href='{$link}' target='_blank'>Please show</a>
            </div>
        ";

        return [
            'message' => $message,
            'link' => $link,
        ];
    }
}
