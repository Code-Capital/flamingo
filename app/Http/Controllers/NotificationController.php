<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // Fetch user's own notifications
        $allNotifications = $user->notifications()->latest()->paginate(getPaginated());

        // // Fetch notifications related to the user's posts
        // $postNotifications = $user->posts()->with('notifications')->get()->pluck('notifications')->flatten();

        // // Merge both collections
        // $allNotifications = $notifications->merge($postNotifications);

        return view('user.notification', get_defined_vars());
    }
}
