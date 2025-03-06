<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is logged in and has role "admin"
        if (Auth::check() && Auth::user()->role === 'Admin') {
            return $next($request);
        }

        // Redirect non-admin users (Optional: You can change this to abort(403))
        return redirect('/')->with('error', 'Unauthorized access');
    }
}
