<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if (Auth::check() && (Auth::user()->is_admin == '2' || Auth::user()->is_admin == '1' || Auth::user()->is_admin == '3')) {
            return $next($request);
        }else {
            return redirect()->back(); 
        }
    }
}
