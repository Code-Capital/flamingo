<?php

namespace App\Events;

use App\Models\Post;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;

class PostCreatedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $post;

    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
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
     * Get the data to broadcast with the event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        // Generate the link to the post
        $postLink = route('post.edit', $this->post->uuid);

        // Create the HTML message
        $body = limitString($this->post->body, 20);
        $message = "
            <div class='notification'>
                <strong>{$this->post?->user?->full_name}</strong> create a new post <a href='{$postLink}' target='_blank'>{$body}</a>
            </div>
        ";

        return [
            'message' => $message,
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'full_name' => $this->user->user_name,
            'link' => $postLink,
        ];
    }
}
