<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPremiumStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Check if the user's 3-day trial has expired
            if ($user->premium_expires_at && now()->gt($user->premium_expires_at)) {
                // If expired, revoke premium access
                $user->is_subscribed = 0;
                $user->premium_expires_at = null; // Clear the premium expiry date
                $user->save();
            }
        }

        return $next($request);
    }
}
