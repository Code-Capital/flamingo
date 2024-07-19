<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Event;
use App\Models\Interest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::id();
        $events = Event::byUser($user)
            ->with(['interests:id,name'])
            ->latest()
            ->get();
        return view('event.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $interests = Interest::get();
        return view('event.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        DB::beginTransaction();
        try {
            $event = Event::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'location' => $request->location,
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
                        'file_path' => $image->store('/media/events/' . $event->id, 'public'),
                        'file_type' => $image->getClientOriginalExtension(),
                    ]);
                }
            }

            $event->interests()->attach((array) $request->interests);

            DB::commit();

            return to_route('events.index')->with('success', 'Event created successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return to_route('events.create')->with('error', 'Error occurred. Please try again later.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): View
    {
        $event = $event->load(['acceptedMembers', 'pendingRequests', 'rejectedRequests']);
        // dd($event->toArray());
        return view('event.show', get_defined_vars());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    public function friends(): View
    {
        return view('event.friends');
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
            : $this->sendErrorResponse('Error occurred', 'Error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);;
    }
}
