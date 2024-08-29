<?php

namespace App\Jobs;

use App\Events\EventCreatedEvent;
use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EventCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;

    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct(Event $event, User $user)
    {
        $this->user = $user;
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->user->friends as $friend) {
            Log::info('JOB -> Event created: '.$this->event->title);
            broadcast(new EventCreatedEvent($this->event, $friend));
        }
    }
}
