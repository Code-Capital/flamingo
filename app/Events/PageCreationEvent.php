<?php

namespace App\Events;

use App\Models\Page;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PageCreationEvent implements shouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Page $page, public User $user)
    {
        $this->page = $page;
        $this->user = $user;
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
     * Get the data to broadcast.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        // Generate the link to the post
        $pageLink = route('pages.show', $this->page->slug);

        // Create the HTML message
        $body = limitString($this->page->name, 20);
        $message = "
            <div class='notification'>
                <strong>{$this->user->full_name}</strong> create a new page <a href='{$pageLink}' target='_blank'>{$body}</a>
            </div>
        ";

        return [
            'message' => $message, // The complete HTML message
            'evemt_id' => $this->page->id,
            'user_id' => $this->user->id,
            'full_name' => $this->user->full_name,
            'link' => $pageLink,
        ];
    }
}
