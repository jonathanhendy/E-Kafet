<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isPembeli
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
        if (\Auth::user() &&  \Auth::user()->isPembeli == true) {
             return $next($request);
        }

        return back()->with('error','Opps, You\'re not penjual');
    }
}