<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontendAuthenticate
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
        if (! $request->expectsJson()) {
            //TODO SSDEV Redirect to URL before signup
            session(['urlBeforeSignup' => $request->url()]);
            return route('frontend.signup.index');
        }        
    }
}
