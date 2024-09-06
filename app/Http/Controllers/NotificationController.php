<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // Fetch user's own notifications
        $allNotifications = DatabaseNotification::where('notifiable_id', $user->id)
            ->whereNull('read_at')->latest()->paginate(getPaginated());

        return view('user.notification', get_defined_vars());
    }

    public function readAll()
    {
        $user = Auth::user();
        DatabaseNotification::where('notifiable_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return redirect()->back();
    }

    public function read($id)
    {
        $user = Auth::user();
        DatabaseNotification::where('id', $id)
            ->where('notifiable_id', $user->id)
            ->update(['read_at' => now()]);

        return redirect()->back();
    }
}
