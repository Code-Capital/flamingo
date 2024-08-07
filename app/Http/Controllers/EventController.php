<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Interest;
use App\Models\Location;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $events = Event::byUser($user->id)
            ->with(['interests:id,name'])
            ->latest()
            ->paginate(getPaginated());

        return view('event.index', get_defined_vars());
    }

    public function create(): View
    {
        $interests = Interest::get();
        $locations = Location::get();

        return view('event.create', get_defined_vars());
    }

    public function store(StoreEventRequest $request)
    {
        DB::beginTransaction();
        try {
            $event = Event::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'location_id' => $request->location_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'thumbnail' => $request->file('thumbnail')->store('media/events/thumbnail/', 'public'),
                'description' => $request->description,
                'rules' => $request->rules,
                'status' => $request->status,
            ]);

            if ($request->has('images') && is_array($request->images)) {
                foreach ($request->images as $image) {
                    $event->media()->create([
                        'file_path' => $image->store('/media/events/'.$event->id, 'public'),
                        'file_type' => $image->getClientOriginalExtension(),
                    ]);
                }
            }

            $event->interests()->sync((array) $request->interests);

            DB::commit();

            return to_route('events.index')->with('success', 'Event created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('events.create')->with('error', 'Error occurred. Please try again later.'.$th->getMessage());
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

        DB::beginTransaction();
        try {
            $event->update([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'location_id' => $validated['location_id'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'thumbnail' => $request->file('thumbnail') ? $request->file('thumbnail')->store('media/events/thumbnail/', 'public') : $event->thumbnail,
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
                    $path = $image->store('/media/events/'.$event->id, 'public');

                    // Create new media record
                    $newMedia = $event->media()->create([
                        'file_path' => $path,
                        'file_type' => $image->getClientOriginalExtension(),
                    ]);

                    // Collect the IDs of new media
                    $newMediaIds[] = $newMedia->id;
                }

                // Delete old media that is not in the new list
                $mediaToDelete = array_diff($existingMediaIds, $newMediaIds);
                if (! empty($mediaToDelete)) {
                    $event->media()->whereIn('id', $mediaToDelete)->delete();
                }
            }

            $event->interests()->sync((array) $request->interests);

            DB::commit();

            return to_route('events.index')->with('success', 'Event updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();

            return to_route('events.edit', $event)->with('error', 'Error occurred. Please try again later.'.$th->getMessage());
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
        $event->allMembers()->detach($user->id);
        if ($request->ajax()) {
            return $this->sendSuccessResponse($user, 'Member removed successfully', Response::HTTP_OK);
        }

        return back()->with('success', 'Member removed successfully');
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

        $messages = ($request->status === 'accepted') ? 'Request accepted successfully' : 'Request rejected successfully';

        return ($response)
            ? $this->sendSuccessResponse($user, $messages, Response::HTTP_OK)
            : $this->sendErrorResponse('Error occurred', 'Error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function joinEvent(Event $event): JsonResponse
    {
        try {
            $user = Auth::user();

            // Check if the user is already a member of the event
            if ($event->allMembers()->where('user_id', $user->id)->exists()) {
                return $this->sendErrorResponse('You are already a member of this event', Response::HTTP_OK);
            }

            // Add the user as a member of the event
            $event->allMembers()->attach($user->id);

            return $this->sendSuccessResponse($event, 'You have joined the event successfully', Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occurred', 'Error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function eventPost(Request $request, Event $event): RedirectResponse
    {
        $user = Auth::user();
        $post = $event->posts()->create([
            'user_id' => $user->id,
            'body' => $request->body,
            'is_private' => $request->is_private ?? false,
        ]);

        // Check if media files were uploaded
        if ($request->hasFile('media')) {
            $mediaFiles = $request->file('media');
            foreach ($mediaFiles as $mediaFile) {
                $mediaPath = $mediaFile->store('/media/posts/'.$user->id, 'public'); // Example storage path
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
