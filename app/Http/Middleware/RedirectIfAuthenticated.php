<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfAuthenticated
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure                 $next
	 * @param  string|null              $guard
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = NULL)
	{
		if (\Auth::guard($guard)->check()) {
			return redirect()->route('page.home');
		}

		return $next($request);
	}
}
