<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Ensure only authenticated users with 'admin' role can access
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        // Redirect if user is not an admin
        return redirect('/'); 
    }
}
