<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(): View
    {
        $notifications = auth()->user()->notifications;
        return view('user.notification', get_defined_vars());
    }
}
