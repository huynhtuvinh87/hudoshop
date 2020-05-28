<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role == config('global.role.admin')) {
            return $next($request);
        }

        return redirect('/'); // If user is not an admin.
    }
}
