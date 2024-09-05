<?php

namespace App\Jobs;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use App\Chatify\CustomChatify;
use Illuminate\Support\Facades\Log;
use App\Enums\NotificationStatusEnum;
use App\Events\GroupChatCreatedEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
    public function __construct(Request $request, string $groupName, Event $event, string $groupImage = null, array $userIds = [])
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

            // $eventChatLink = route('channel_id', $responseData['channel']['id']);
            // // Create the HTML message
            // $body = limitString($this->event->title, 20);
            // $user = $this->event->user;
            // $message = "
            //     <div class='notification'>
            //         <strong>{$user->full_name}</strong> new group chat has been created <a href='{$eventChatLink}' target='_blank'>{$body}</a>
            //     </div>
            // ";

            // $user->notifications()->create([
            //     'type' => NotificationStatusEnum::EVENTCHATCREATED->value,
            //     'data' => json_encode([
            //         'message' => $message,
            //         'event_id' => $this->event->id,
            //         'channel_id' => $responseData['channel']['id'],
            //         'user_id' => $user->id,
            //         'user_name' => $user->full_name,
            //     ]),
            // ]);
        } else {
            Log::error('Group chat creation failed');
        }
    }
}
