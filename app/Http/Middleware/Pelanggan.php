<?php

namespace App\Http\Middleware;

use Closure;

class Pelanggan
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
        if(empty(session('pelanggan'))){
            return redirect()->route('login');
        }
        else{
            return $next($request);
        }
    }
}
