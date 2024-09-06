<?php

namespace App\Events;

use App\Models\Event;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupChatCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $event;

    public $user;

    public $channel;

    /**
     * Create a new event instance.
     */
    public function __construct(Event $event, User $user, $channel)
    {
        $this->event = $event;
        $this->user = $user;
        $this->channel = $channel;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('notification.'.$this->user->id),
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
        $eventChatLink = route('channel_id', $this->channel->id);

        // Create the HTML message
        $body = limitString($this->event->title, 20);
        $user = $this->event->user;
        $message = "
                <div class='notification'>
                    New group chat has been created <a href='{$eventChatLink}' target='_blank'>{$body}</a>
                </div>
            ";

        return [
            'message' => $message,
            'event_id' => $this->event->id,
            'channel_id' => $this->channel->id,
            'user_id' => $this->user->id,
            'full_name' => $this->user->full_name,
            'link' => $eventChatLink,
        ];
    }
}
