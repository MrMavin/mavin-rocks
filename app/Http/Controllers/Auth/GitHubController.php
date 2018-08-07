<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

class GitHubController extends Controller
{
	public function redirectToProvider()
	{
		return \Socialite::driver('github')->redirect();
	}

	public function handleProviderCallback()
	{
		$userData = \Socialite::driver('github')->user();

		$email = $userData->email;

		$user = User::whereEmail($email)->first();

		if (!$user) {
			abort(401, 'Your account lacks required permissions');
		}

		\Auth::login($user);

		return redirect()->intended(route('page.home'));
	}
}
