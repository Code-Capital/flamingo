<?php

namespace App\Listeners;

use App\Enums\NotificationStatusEnum;
use App\Events\PostCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPostCreationNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreatedEvent $event): void
    {
        $postLink = route('post.edit', $event->post->uuid);

        // Create the HTML message
        $message = "
            <div class='notification'>
                <strong>{$event->user->full_name}</strong> has posted a new update:
                <a href='{$postLink}' target='_blank'>\"{$event->post->title}\"</a>
            </div>
        ";

        $event->user->notifications()->create([
            'type' => NotificationStatusEnum::POSTCREATED->value,
            'data' => json_encode([
                'message' => $message,
                'post_id' => $event->post->id,
                'post_body' => $event->post->body,
                'user_id' => $event->user->id,
                'full_name' => $event->user->full_name,
            ]),
        ]);
    }
}
