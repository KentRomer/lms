<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class InstructorMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'instructor') {
            return redirect('/login')->withErrors('Access denied.');
        }

        return $next($request);
    }
}
