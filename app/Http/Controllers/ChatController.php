<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $friends = $user->acceptedFriends;

        return view('user.messages', get_defined_vars());
    }
}
