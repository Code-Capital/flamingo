<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addFriend(Request $request)
    {
        // Add the friend to the authenticated user's friends list
        $request->user()->friends()->attach($request->input('friend_id'));

    }
}
