<?php

return [
	'github' => [
		'client_id' => env('GITHUB_CLIENT_ID'),
		'client_secret' => env('GITHUB_CLIENT_SECRET'),
		'hook_secret' => env('GITHUB_HOOK_SECRET'),
		'redirect' => '/auth/github/callback',
	],
	'matomo' => [
		'url' => env('MATOMO_URL', FALSE)
	]
];
