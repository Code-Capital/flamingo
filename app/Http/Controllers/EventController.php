<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Interest;
use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\EventCreatedJob;
use App\Chatify\CustomChatify;
use Illuminate\Http\JsonResponse;
use App\Jobs\GroupChatCreationJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Enums\NotificationStatusEnum;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    use AuthorizesRequests;

    public $customChatify;

    public function __construct()
    {
        $this->customChatify = new CustomChatify();
    }


    public function index(): View
    {
        $user = Auth::user();
        $events = Event::byUser($user->id)
            ->with(['interests:id,name'])
            ->latest()
            ->paginate(getPaginated());
        $remianingEventCount = $user->getRemainingEvents();

        return view('event.index', get_defined_vars());
    }

    public function create(): View
    {
        $user = Auth::user();
        $this->authorize('create', Event::class);

        $interests = Interest::get();
        $locations = Location::get();
        $remianingEventCount = $user->getRemainingEvents();

        return view('event.create', get_defined_vars());
    }

    public function store(StoreEventRequest $request)
    {
        try {
            $user = Auth::user();
            $this->authorize('create', Event::class);
            DB::transaction(function () use ($request, $user) {

                $thumbnailPath = $request->hasFile('thumbnail')
                    ? $request->file('thumbnail')->store('media/events/thumbnail', 'public')
                    : null;
                $event = Event::create([
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'location_id' => $request->location_id,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'thumbnail' => $thumbnailPath,
                    'description' => $request->description,
                    'rules' => $request->rules,
                    'status' => $request->status,
                ]);

                if ($request->has('images') && is_array($request->images)) {
                    foreach ($request->file('images') as $image) {
                        $event->media()->create([
                            'file_path' => $image->store('/media/events/' . $event->id, 'public'),
                            'file_type' => $image->getClientOriginalExtension(),
                        ]);
                    }
                }

                $event->interests()->sync((array) $request->interests);

                if ($event->isPublished()) {
                    Log::info('Event created and published and runnig job');
                    dispatch(new EventCreatedJob($event, $user));

                    // Create a group chat for the event
                    Log::info('Creating group chat for the event');
                    $response = $this->customChatify->createGroupChat(
                        request: $request,
                        groupName: 'Event ' . ucfirst($event->title),
                        avatar: $thumbnailPath,
                    );

                    // Decode JSON into an associative array
                    $responseData = $response->getData(true);

                    if ($responseData['status'] && $responseData['channel']) {
                        $event->update([
                            'channel_id' => $responseData['channel']['id'],
                        ]);

                        $eventChatLink = route('channel_id', $responseData['channel']['id']);

                        // Create the HTML message
                        $body = limitString($event->title, 20);
                        $message = "
                            <div class='notification'>
                                <strong>{$user->full_name}</strong> new group chat has been created <a href='{$eventChatLink}' target='_blank'>{$body}</a>
                            </div>
                        ";

                        $user->notifications()->create([
                            'type' => NotificationStatusEnum::EVENTCHATCREATED->value,
                            'data' => json_encode([
                                'message' => $message,
                                'event_id' => $event->id,
                                'channel_id' => $responseData['channel']['id'],
                                'user_id' => $user->id,
                                'user_name' => $user->full_name,
                            ]),
                        ]);
                    }
                }
            });

            return to_route('events.index')->with('success', 'Event created successfully');
        } catch (AuthorizationException $e) {
            return to_route('events.create')
                ->with('error', 'You have reached the maximum number of events you can create this month.' . $e->getMessage());
        } catch (\Throwable $th) {
            return to_route('events.create')->with('error', 'Error occurred. Please try again later.' . $th->getMessage());
        }
    }

    public function show(Event $event): View
    {
        $event = $event->load(['acceptedMembers', 'pendingRequests', 'rejectedRequests']);
        $posts = $event->posts()
            ->with(['user', 'media', 'likes', 'comments', 'comments.user', 'comments.replies'])
            ->withCount(['comments', 'likes'])
            ->latest()->paginate(getPaginated());
        $user = Auth::user();

        $media = $event->posts()->with('media')->get()->pluck('media')->flatten();

        return view('event.show', get_defined_vars());
    }

    public function edit(Event $event)
    {
        $interests = Interest::get();
        $locations = Location::get();
        $event = $event->load(['acceptedMembers', 'pendingRequests', 'rejectedRequests']);

        return view('event.edit', get_defined_vars());
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($request, $event, $validated) {
                $validated['thumbnail'] = $event->thumbnail;
                if ($request->hasFile('thumbnail')) {
                    if (Storage::exists($event->thumbnail)) {
                        Storage::delete($event->thumbnail);
                    }
                    $validated['thumbnail'] = $request->file('thumbnail')->store('media/events/thumbnail', 'public');
                }

                $event->update([
                    'title' => $validated['title'],
                    'slug' => Str::slug($validated['title']),
                    'location_id' => $validated['location_id'],
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date'],
                    'thumbnail' => $validated['thumbnail'],
                    'description' => $validated['description'],
                    'rules' => $validated['rules'],
                    'status' => $validated['status'],
                ]);

                // Get the IDs of the existing media to be removed later
                $existingMediaIds = $event->media->pluck('id')->toArray();

                // Store new media
                if ($request->has('images') && is_array($request->images)) {
                    $newMediaIds = [];

                    foreach ($request->images as $image) {
                        $path = $image->store('/media/events/' . $event->id, 'public');

                        $newMedia = $event->media()->create([
                            'file_path' => $path,
                            'file_type' => $image->getClientOriginalExtension(),
                        ]);

                        $newMediaIds[] = $newMedia->id;
                    }

                    // Delete old media that is not in the new list
                    $mediaToDelete = array_diff($existingMediaIds, $newMediaIds);
                    if (! empty($mediaToDelete)) {
                        $event->media()->whereIn('id', $mediaToDelete)->delete();
                    }
                }

                $event->interests()->sync((array) $request->interests);

                if ($event->isPublished()) {
                    $eventChat = $event->channel;
                    if ($eventChat) {
                        $eventChat->name = $event->title ? 'Event ' . ucfirst($event->title) :  $eventChat;

                        if ($request->hasFile('thumbnail')) {
                            // allowed extensions
                            $allowed_images = $this->customChatify->getAllowedImages();

                            $file = $request->file('thumbnail');
                            // check file size
                            if ($file->getSize() <  $this->customChatify->getMaxUploadSize()) {
                                if (in_array(strtolower($file->extension()), $allowed_images)) {
                                    $avatar = Str::uuid() . "." . $file->extension();
                                    // $update = $eventChat->update(['avatar' => $avatar]);
                                    $eventChat->avatar = $avatar;
                                    $file->storeAs(config('chatify.channel_avatar.folder'), $avatar, config('chatify.storage_disk_name'));
                                    // $success = $update ? 1 : 0;
                                }
                            }
                        }

                        $save = $eventChat->save();

                        if ($save) {
                            $user = Auth::user();
                            $message = $this->customChatify->newMessage([
                                'from_id' => $user->id,
                                'to_channel_id' => $event->channel_id,
                                'body' => $user?->full_name . ' has changed the group name to: ' . $eventChat->name,
                                'attachment' => null,
                            ]);
                            $message->user_name = $user->user_name;
                            $message->user_email = $user->email;

                            $messageData = $this->customChatify->parseMessage($message, null);
                            $this->customChatify->push("private-chatify." . $event->channel_id, 'messaging', [
                                'from_id' => $user->id,
                                'to_channel_id' =>  $event->channel_id,
                                'message' => $this->customChatify->messageCard($messageData, true)
                            ]);
                        }
                    }
                }
            });
            return to_route('events.index')->with('success', 'Event updated successfully');
        } catch (\Throwable $th) {
            Log::error('Error occurred while updating event', json_encode(['error' => $th->getMessage()]));
            return to_route('events.edit', $event->slug)->with('error', 'Error occurred. Please try again later.' . $th->getMessage());
        }
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return to_route('events.index')->with('success', 'Event deleted successfully');
    }

    public function friends(): View
    {
        $friends = Auth::user()->acceptedFriends;

        return view('event.friends', get_defined_vars());
    }

    public function removeMember(Request $request, Event $event, User $user)
    {
        $deattach = $event->allMembers()->detach($user->id);
        if ($deattach && $event->channel) {
            $event->channel->users()->detach($user->id);

            $message = $this->customChatify->newMessage([
                'from_id' => $event->user->id,
                'to_channel_id' => $event->channel_id,
                'body' => 'user ' . $user->full_name . ' has been removed from the group',
                'attachment' => null,
            ]);

            $message->user_name = $user->user_name;
            $message->user_email = $user->email;

            $messageData = $this->customChatify->parseMessage($message, null);
            $this->customChatify->push("private-chatify." . $event->channel_id, 'messaging', [
                'from_id' => $user->id,
                'to_channel_id' =>  $event->channel_id,
                'message' => $this->customChatify->messageCard($messageData, true)
            ]);
        }
        if ($request->ajax()) {
            return $this->sendSuccessResponse($user, 'Member removed successfully', Response::HTTP_OK);
        }

        return back()->with('success', 'Member removed successfully');
    }

    public function leaveEvent(Request $request, Event $event)
    {
        try {
            $leave = $event->allMembers()->detach($request->user()->id);

            return $this->sendSuccessResponse($leave, 'You have left the event successfully', Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occurred' . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function statusUpdateRequest(Request $request, Event $event, User $user)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:accepted,rejected'],
        ]);

        if ($validator->fails()) {
            return $this->sendErrorResponse($validator->errors(), 'Validation error', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Update the pivot record for the specific event and user
        $response = $event->allMembers()->updateExistingPivot($user->id, [
            'status' => $request->status,
        ]);

        if ($request->status === 'accepted') {

            if ($event->channel) {
                $sync = $event->channel->users()->syncWithoutDetaching($user->id);

                // Create a group chat for the event
                if ($sync) {
                    $message = $this->customChatify->newMessage([
                        'from_id' => $user->id,
                        'to_channel_id' => $event->channel_id,
                        'body' => $user->full_name . ' has joined the group',
                        'attachment' => null,
                    ]);
                    $message->user_name = $user->user_name;
                    $message->user_email = $user->email;

                    $messageData = $this->customChatify->parseMessage($message, null);
                    $this->customChatify->push("private-chatify." . $event->channel_id, 'messaging', [
                        'from_id' => $user->id,
                        'to_channel_id' =>  $event->channel_id,
                        'message' => $this->customChatify->messageCard($messageData, true)
                    ]);
                }
            }

            $eventLink = route('events.show', $event->slug);
            $body = limitString($event->title, 20);
            $type = NotificationStatusEnum::EVENTREQUESTACCEPTED->value;
        } else {
            $type = NotificationStatusEnum::EVENTREQUESTREJECTED->value;
            $eventLink = 'javascript:void(0)';
        }
        $message = "<div class='notification'>
                            <a href='{$eventLink}' target='_blank'>
                                Your request sattus for <strong>{$event->title}</strong>  has been {$request->status}. {$body}
                            </a>
                        </div>
                    ";

        $user->notifications()->create([
            'type' => $type,
            'data' => json_encode([
                'message' => $message,
                'user_id' => $user->id,
                'event_id' => $event->id,
            ]),
        ]);

        $messages = ($request->status === 'accepted') ? 'Request accepted successfully' : 'Request rejected successfully';

        return ($response)
            ? $this->sendSuccessResponse($user, $messages, Response::HTTP_OK)
            : $this->sendErrorResponse('Error occurred while updating request status', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function joinEvent(Request $request, Event $event): JsonResponse
    {
        try {
            $user = Auth::user();
            $this->authorize('canjoin', $event);

            // Check if the user is already a member of the event
            if ($event->allMembers()->where('user_id', $user->id)->exists()) {
                return $this->sendErrorResponse('You are already a member of this event', Response::HTTP_OK);
            }

            // Add the user as a member of the event
            $event->allMembers()->attach($user->id, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $this->sendSuccessResponse($event, 'You have joined the event successfully', Response::HTTP_OK);
        } catch (AuthorizationException $e) {
            $message = 'Total limit reached. You cannot join this event' . $e->getMessage();

            return $this->sendErrorResponse($message, Response::HTTP_FORBIDDEN);
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occurred' . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eventPost(Request $request, Event $event): RedirectResponse
    {
        $user = Auth::user();
        $post = $event->posts()->create([
            'uuid' => Str::uuid(),
            'user_id' => $user->id,
            'body' => $request->body,
            'is_private' => $request->is_private ?? false,
        ]);

        // Check if media files were uploaded
        if ($request->hasFile('media')) {
            $mediaFiles = $request->file('media');
            foreach ($mediaFiles as $mediaFile) {
                $mediaPath = $mediaFile->store('/media/posts/' . $user->id, 'public'); // Example storage path
                $post->media()->create([
                    'file_path' => $mediaPath,
                    'file_type' => $mediaFile->getClientOriginalExtension(), // Example file type
                ]);
            }
        }

        $post->notifications()->create([
            'type' => 'post',
            'data' => json_encode([
                'message' => 'New post created',
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]),
        ]);

        return back()->with('success', 'Post created successfully');
    }

    public function joinedEvents(): View
    {
        $user = Auth::user();
        $events = $user->joinedEvents()
            ->with(['interests:id,name'])
            ->latest()
            ->paginate(getPaginated());

        return view('event.joined', get_defined_vars());
    }

    public function eventClose(Event $event): RedirectResponse
    {
        $event->closeEvent();
        return back()->with('success', 'Event closed successfully');
    }
}
