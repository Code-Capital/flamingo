<?php

namespace App\Listeners;

use App\Events\EventCreatedEvent;
use Illuminate\Support\Facades\Log;
use App\Enums\NotificationStatusEnum;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventCreatedListener implements ShouldQueue
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
    public function handle(EventCreatedEvent $event): void
    {
        Log::info('LISTENER -> Event created: ' . $event->event->title);
        $event->user->notifications()->create([
            'type' => NotificationStatusEnum::POSTCREATED->value,
            'data' => json_encode([
                'message' => 'New event created by ' . $event->user->name,
                'event_id' => $event->event->id,
                'event' => $event->event,
                'user_id' => $event->user->id,
                'user_name' => $event->user->full_name,
            ]),
        ]);
    }
}
