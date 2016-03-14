<?php

namespace App\Http\Middleware;

use Closure,Auth;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        echo  "here"; die;
        if(!Auth::check())
        {
            return redirect('/login');
        }

        return $next($request);
    }
}
