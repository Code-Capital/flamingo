<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Interest;
use App\Models\Location;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $authUser = Auth::user();
        $searchTerm = null;
        $location = null;
        $interests = array_merge($authUser->interests->pluck('id')->toArray());
        $selectedInterests = [];
        if ($request->has('find')) {
            $searchTerm = $request->input('q', '');
            $location = $request->input('location_id', '');
            $interests = $request->input('interests', []);
            $selectedInterests = $interests;
        }

        $users = User::where('id', '!=', Auth::id())
            // ->byNotUser($authUser->id)
            ->bySearch($searchTerm)
            ->byInterests($interests)
            ->byLocation($location)
            ->whereDoesntHave('friends', function ($query) use ($authUser) {
                $query->where('user_id', $authUser->id);
            })
            ->paginate(getPaginated());

        // Fetch all interests
        $interests = Interest::get();
        $locations = Location::get();

        return view('user.search', get_defined_vars());
    }

    public function eventSearch(Request $request): View
    {
        $user = Auth::user();
        $eventJoiningCount = $user->getRemainingEventsJoinings();
        // $userInterests = $user->interests->pluck('id')->toArray();

        $searchTerm = null;
        $location_id = null;
        $interests = array_merge($user->interests->pluck('id')->toArray());
        $selectedInterests = [];
        if ($request->has('find')) {
            $searchTerm = $request->input('q', '');
            $location_id = (int) $request->input('location_id', '');
            $interests = $request->input('interests', []);
            $selectedInterests = $interests;
        }
        $events = Event::with(['interests', 'allMembers'])
            // ->byNotUser($user->id)
            ->published()
            ->bySearch($searchTerm)
            ->byInterests($interests)
            ->byLocation($location_id)
            ->whereDoesntHave('reports', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // ->upcoming()
            // ->ongoing()
            ->latest()
            ->paginate(getPaginated());

        $interests = Interest::get();
        $locations = Location::get();

        return view('event.search', get_defined_vars());
    }
}
