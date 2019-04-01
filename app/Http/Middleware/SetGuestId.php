<?php

namespace App\Http\Middleware;

use Closure;

class SetGuestId
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

        if(!auth()->check() && !session()->has("user_id")){
            session(['user_id' => md5(request()->ip().now())]);
        }

        return $next($request);
    }
}
