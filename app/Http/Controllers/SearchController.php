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
        // Get the search term and interests from the request
        $searchTerm = $request->input('q', '');
        $selectedInterests = $request->input('interests', []);
        $location = $request->input('location', '');

        // Fetch users based on the filters if any of the filters are present
        $users = [];
        $authUser = Auth::user();
        $authUser->interests->pluck('id')->toArray();
        $merged = array_merge($authUser->interests->pluck('id')->toArray(), $selectedInterests);
        $users = User::where('id', '!=', Auth::id())
            // ->byNotUser($authUser->id)
            ->bySearch($searchTerm)
            ->byInterests($merged)
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
        $userInterests = $user->interests->pluck('id')->toArray();

        $searchTerm = $request->input('q', '');
        $selectedInterests = $request->input('interests', []);
        $merged = array_merge($user->interests->pluck('id')->toArray(), $userInterests);

        $events = Event::with(['interests', 'allMembers'])
            // ->byNotUser($user->id)
            ->published()
            ->bySearch($searchTerm)
            ->byInterests($merged)
            ->byLocation($request->location_id)
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
