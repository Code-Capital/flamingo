<?php

namespace App\Listeners;

use App\Enums\NotificationStatusEnum;
use App\Events\PageCreationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class PageCreationListener implements ShouldQueue
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
    public function handle(PageCreationEvent $event): void
    {
        // Generate the link to the post
        $pageLink = route('events.show', $event->page->slug);

        // Create the HTML message
        $body = limitString($event->page->title, 20);
        $message = "
            <div class='notification'>
                <strong>{$event->user->full_name}</strong> Create a new Page <a href='{$pageLink}' target='_blank'>{$body}</a>
            </div>
        ";

        $event->user->notifications()->create([
            'type' => NotificationStatusEnum::PAGECREATED->value,
            'data' => json_encode([
                'message' => $message,
                'page_id' => $event->page->id,
                'user_id' => $event->user->id,
                'user_name' => $event->user->full_name,
            ]),
        ]);
    }
}
