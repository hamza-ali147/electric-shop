<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is an admin
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return $next($request);
        }

        // If the user is not an admin, redirect them to the home page
        return redirect('/');
    }
}
