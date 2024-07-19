<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        // Get the search term and interests from the request
        $searchTerm = $request->input('q', '');
        $selectedInterests = $request->input('interests', []);

        // Fetch users based on the filters if any of the filters are present
        $users = [];
        if (($request->find == 'submit') && ($searchTerm || $selectedInterests)) {
            $users = User::bySearch($searchTerm)
                ->byInterests($selectedInterests)
                ->byNotUser(Auth::user()->id)
                ->get();
        }

        // Fetch all interests
        $interests = Interest::get();

        return view('user.search', get_defined_vars());
    }

    public function eventSearch(Request $request): View
    {
        $user = Auth::id();
        $searchTerm = $request->input('q', '');
        $selectedInterests = $request->input('interests', []);

        $events = Event::with('interests')
            ->published()
            ->bySearch($searchTerm)
            ->byInterests($selectedInterests)
            ->byNotUser($user)
            ->latest()
            ->get();

        $interests = Interest::get();

        return view('event.search', get_defined_vars());
    }
}
