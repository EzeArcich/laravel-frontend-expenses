<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('jwt_token')) {
            return redirect('/login');
        }

        return $next($request);
    }
}

