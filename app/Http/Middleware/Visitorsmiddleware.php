<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentinel;

class Visitorsmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Sentinel::check())
        return $next($request);
        else
            return redirect('/');
    }
}
