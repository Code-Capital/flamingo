<?php

namespace App\Http\Controllers;

use App\Models\DogsInformation;
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

        $dog_breed = $request->input('dog_breed', '');
        $dog_gender = $request->input('dog_gender', '');
        $kennel_club = $request->input('kennel_club', '');
        $dog_working_club = $request->input('dog_working_club', '');
        $dog_withers_height = $request->input('dog_withers_height', '');
        $weight = $request->input('weight', '');
        $size = $request->input('size', '');
        $castrated = $request->input('castrated', '');
        $target = $request->input('target', '');
        $furr = $request->input('furr', '');
        $drawing = $request->input('drawing', '');
        $hills = $request->input('hills', '');

        $users = User::where('id', '!=', Auth::id())
            // ->byNotUser($authUser->id)
            ->bySearch($searchTerm)
            ->byInterests($interests)
            ->byLocation($location)

            ->byDogBreed($dog_breed)
            ->byDogGender($dog_gender)
            ->byKennelClub($kennel_club)
            ->byDogWorkingClub($dog_working_club)
            ->byDogWithersHeight($dog_withers_height)
            ->byWeight($weight)
            ->bySize($size)
            ->byCastrated($castrated)
            ->byTarget($target)
            ->byFurr($furr)
            ->byDrawing($drawing)
            ->byHills($hills)

            ->whereDoesntHave('friends', function ($query) use ($authUser) {
                $query->where('user_id', $authUser->id);
            })
            ->paginate(getPaginated());

        // Fetch all interests
        $interests = Interest::get();
        $locations = Location::get();
        $dogs_information = DogsInformation::all();
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
        // dd($pages);
        return view('page.search', get_defined_vars());
    }
}
