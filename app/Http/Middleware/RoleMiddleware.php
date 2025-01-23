<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role_id == $role) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access!');
    }
}
