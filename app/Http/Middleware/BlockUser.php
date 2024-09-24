<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BlockUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->expectsJson()) {
            // Return a JSON response for AJAX requests
            return response()->json([
                'success' => false,
                'message' => 'Your account is blocked. Please contact the administrator.'
            ], 403);
        } else {
            // Return a standard abort response for regular requests
            return abort(403, 'You are blocked. Please contact the administrator.');
        }
        return $next($request);
    }
}
