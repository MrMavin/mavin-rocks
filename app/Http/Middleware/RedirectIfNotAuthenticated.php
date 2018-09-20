<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! \Auth::check()) {
            abort(401);
        }

        return $next($request);
    }
}
