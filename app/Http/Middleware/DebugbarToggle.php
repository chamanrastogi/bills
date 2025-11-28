<?php

namespace App\Http\Middleware;

use Barryvdh\Debugbar\Facades\Debugbar;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DebugbarToggle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Disable Debugbar by default
        Debugbar::disable();

        // Proceed only if Debugbar is installed (fails silently if missing)
        if (! class_exists(\Barryvdh\Debugbar\Facades\Debugbar::class)) {
            return $next($request);
        }

        // Enable only for logged-in users with allowed roles
        if (Auth::check()) {
            $user = Auth::user();

            // Define allowed roles
            $allowedRoles = ['admin'];

            // If the user has the correct role, enable Debugbar
            if (isset($user->role) && in_array($user->role, $allowedRoles, true)) {
                Debugbar::enable();
            }
        }

        return $next($request);
    }
}
