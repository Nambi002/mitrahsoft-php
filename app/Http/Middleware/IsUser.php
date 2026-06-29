<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    


/*
    
public function handle($request, Closure $next)
{
    if (Auth::check() && Auth::user()->role === 'user') {
        return $next($request);
    }

    return redirect('/')->with('error', 'Access denied');
}*/


public function handle($request, Closure $next)
{
    if (!Auth::check() || Auth::user()->role !== 'user') {
        Auth::logout();
        return redirect('/login')->with('error', 'Unauthorized access');
    }

    return $next($request);
}


}
