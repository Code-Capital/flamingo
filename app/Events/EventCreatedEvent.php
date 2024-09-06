<?php

namespace App\Events;

use App\Models\Event;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $event;

    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct(Event $event, User $user)
    {
        $this->user = $user;
        $this->event = $event;
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
        // Generate the link to the post
        $eventLink = route('events.show', $this->event->slug);

        // Create the HTML message
        $body = limitString($this->event->title, 20);
        $message = "
            <div class='notification'>
                <strong>{$this->user->full_name}</strong> create a new event <a href='{$eventLink}' target='_blank'>{$body}</a>
            </div>
        ";

        return [
            'message' => $message, // The complete HTML message
            'evemt_id' => $this->event->id,
            'user_id' => $this->user->id,
            'full_name' => $this->user->full_name,
            'link' => $eventLink,
        ];
    }
}
