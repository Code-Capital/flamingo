<?php

namespace App\Jobs;

use App\Events\PageCreationEvent;
use App\Models\Page;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PageCreationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $page;

    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct(Page $page, User $user)
    {
        $this->page = $page;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('PAGE CREATION JOB -> Stated: ');
        foreach ($this->user->acceptedFriends as $friend) {
            Log::info('CREATING JOB EVENTS -> '.$this->page->name);
            broadcast(new PageCreationEvent($this->page, $friend));
        }

        Log::info('PAGE CREATION JOB -> Completed: ');
    }
}
