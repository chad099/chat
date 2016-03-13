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
        if(Auth::check())
        {
          if(Auth::user()->type == 'admin')
            return redirect('/admin');
          else
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
