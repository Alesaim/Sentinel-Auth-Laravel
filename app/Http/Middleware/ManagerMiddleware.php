<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Sentinel;

class ManagerMiddleware
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
        if(Sentinel::check() && Sentinel::getUser()->roles()->first()->slug == 'manager')
            return $next($request);
        else
            return redirect('/');
    }
}
