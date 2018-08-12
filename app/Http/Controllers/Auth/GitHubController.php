<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class GitHubController extends Controller
{
	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function redirectToProvider()
	{
		return \Socialite::driver('github')->redirect();
	}

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function handleProviderCallback()
	{
		$userData = \Socialite::driver('github')->user();

		$email = $userData->email;

		$user = User::whereEmail($email)->first();

		// If user does not exists in the database the application
		// can't provide auth access
		if (!$user) {
			abort(401, 'Your account lacks required permissions');
		}

		\Auth::login($user);

		return redirect()->intended(route('page.home'));
	}
}
