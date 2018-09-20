<?php

namespace App\Http\Middleware;

use Closure;

class APIAuthMiddleware
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
        $apiKey = $request->header('Authorization');
        $user = \Auth::user();

        if (!$user){
            return abort(401, "User not authenticated");
        }

        if ($user->getApiKey() !== $apiKey){
            return abort(401, "API key is wrong");
        }

        return $next($request);
    }
}
