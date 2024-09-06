<?php

namespace App\Jobs;

use App\Chatify\CustomChatify;
use App\Enums\NotificationStatusEnum;
use App\Events\GroupChatCreatedEvent;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class GroupChatCreationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;

    public $request;

    public $groupName;

    public $groupImage;

    public $userIds;

    /**
     * Create a new job instance.
     */
    public function __construct(Request $request, string $groupName, Event $event, ?string $groupImage = null, array $userIds = [])
    {
        $this->event = $event;
        $this->request = $request;
        $this->groupName = $groupName;
        $this->groupImage = $groupImage;
        $this->userIds = $userIds;
    }

    /**
     * Execute the job.
     */
    public function handle(CustomChatify $customChatify): void
    {
        $response = $customChatify->createGroupChat($this->request, $this->groupName, $this->userIds, $this->groupImage);
        // Decode JSON into an associative array
        $responseData = $response->getData(true);

        if ($responseData['status'] && $responseData['channel']) {

            $this->event->update([
                'channel_id' => $responseData['channel']['id'],
            ]);

            broadcast(new GroupChatCreatedEvent($this->event, $this->event->user, $responseData['channel']));
        } else {
            Log::error('Group chat creation failed');
        }
    }
}
