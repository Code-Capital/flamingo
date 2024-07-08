<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        // Get the search term and interests from the request
        $searchTerm = $request->input('q', '');
        $selectedInterests = $request->input('interests', []);

        // Fetch users based on the filters if any of the filters are present
        $users = [];
        if (($request->find == 'submit') && ($request->has('q') || $request->has('interests'))) {
            $users = User::bySearch($searchTerm)
                ->byInterests($selectedInterests)
                ->get();
        }

        // Fetch all interests
        $interests = Interest::get();
        return view('user.search', get_defined_vars());
    }
}
