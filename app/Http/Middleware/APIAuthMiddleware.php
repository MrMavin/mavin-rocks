<?php

namespace App\Http\Middleware;

use App\Models\User;
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

        if ($user){
            if ($user->getApiKey() !== $apiKey){
                return abort(401, "API Key does not match");
            }
        }else{
            $users = User::all();

            foreach($users as $user){
                if ($user->getApiKey() === $apiKey){
                    \Auth::login($user);
                    break;
                }
            }

            if (!\Auth::check()){
                return abort(401, "User not found");
            }
        }


        return $next($request);
    }
}
