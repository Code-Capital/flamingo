<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
use App\Models\Event;
use App\Models\Interest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
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


    public function pagesearch(Request $request): View
    {
        $user = Auth::user();
        $searchTerm = $request->input('q', '');
        $selectedInterests = $request->input('interests', []);

        $mergedInterests = array_merge($selectedInterests, $user->interests->pluck('id')->toArray());

        $pages = Page::bySearch($searchTerm)
            ->byInterests($mergedInterests)
            ->byLocation($request->location_id)
            ->byNotUser(Auth::user()->id)
            ->byPublic()
            ->whereDoesntHave('reports', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->paginate(getPaginated());

        $interests = Interest::all();
        $locations = Location::all();
        $remainingPagesCount = $user->getRemainingPages();

        return view('page.search', get_defined_vars());
    }
}
