<?php

namespace App\Providers;

use App\Http\ViewComposers\BlogComposer;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Paginator::defaultView('common.paginator');

		// Auto login on local environment
		if (env('APP_ENV') == 'local') {
			try {
				if (!\Auth::check()) {

					$user = User::whereEmail(config('me.email'))->first();
					\Auth::login($user);
				}
			} catch (\Exception $e) {}
		}

		\View::composer('blog.*', BlogComposer::class);
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public
	function register()
	{
		//
	}
}
