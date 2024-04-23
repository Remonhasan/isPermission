<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Check if the user's role is user
            if (Auth::user()->role === 'user') {
                // User is user, allow access
                return $next($request);
            }
        }

        // If not user, redirect or return error as needed
        return redirect()->route('login')->with('error', 'Unauthorized access');
    }
}
