<?php

namespace App\Listeners;

use App\Enums\NotificationStatusEnum;
use App\Events\PostCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
        $event->user->notifications()->create([
            'type' => NotificationStatusEnum::POSTCREATED->value,
            'data' => json_encode([
                'message' => 'New post created by ' . $event->user->name,
                'post_id' => $event->post->id,
                'post_body' => $event->post->body,
                'user_id' => $event->user->id,
                'full_name' => $event->user->full_name,
            ]),
        ]);
    }
}
