<?php

namespace App\Jobs;

use App\Events\PostCreatedEvent;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendPostNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;

    public $user;

    /**
     * Create a new job instance.
     */
    public function __construct(Post $post, User $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->user->acceptedFriends as $index => $friend) {
            Log::info('POST CREATION JOB FUNCTION');
            broadcast(new PostCreatedEvent($this->post, $friend));
        }
    }
}
