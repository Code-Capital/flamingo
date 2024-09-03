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
            new Channel('user.' . $this->user->id),
        ];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs(): string
    {
        return 'post-created';
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
        $message = "
            <div class='notification'>
                <strong>{$this->user->full_name}</strong> has posted a new update:
                <a href='{$postLink}' target='_blank'>{$this->post->title}</a>
            </div>
        ";

        return [
            'message' => htmlspecialchars_decode($message), // The complete HTML message
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'full_name' => $this->user->full_name,
            'link' => $postLink,
        ];
    }
}
