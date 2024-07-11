<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $friends = $user->acceptedUsers;

        return view('user.messages', get_defined_vars());
    }
}
