<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\DatabaseNotification;


class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share the unread notification count with all views
        View::composer('*', function ($view) {
            $user = Auth::user();
            $unreadCount = 0;

            if ($user) {
                $unreadCount =  DatabaseNotification::where('notifiable_id', $user->id)
                    ->whereNull('read_at')->count();
            }

            $view->with('unreadNotificationCount', $unreadCount);
        });
    }
}
