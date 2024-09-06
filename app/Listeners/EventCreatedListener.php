<?php

namespace App\Listeners;

use App\Enums\NotificationStatusEnum;
use App\Events\EventCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

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
        Log::info('LISTENER -> Event created: '.$event->event->title);
        $eventLink = route('events.show', $event->event->slug);

        // Create the HTML message
        $body = limitString($event->event->title, 20);
        $message = "
            <div class='notification'>
                <strong>{$event->user->full_name}</strong> create a new event <a href='{$eventLink}' target='_blank'>{$body}</a>
            </div>
        ";

        $event->user->notifications()->create([
            'type' => NotificationStatusEnum::EVENTCREATED->value,
            'data' => json_encode([
                'message' => $message,
                'event_id' => $event->event->id,
                'event' => $event->event,
                'user_id' => $event->user->id,
                'user_name' => $event->user->full_name,
            ]),
        ]);
    }
}
