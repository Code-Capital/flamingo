<?php

namespace App\Listeners;

use App\Events\GroupChatCreatedEvent;
use Illuminate\Support\Facades\Log;

class GroupChatCreationListener
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
    public function handle(GroupChatCreatedEvent $event): void
    {
        Log::info('Group chat created event fired');
    }
}
