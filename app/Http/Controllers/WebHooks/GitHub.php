<?php

namespace App\Http\Controllers\WebHooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class GitHub extends Controller
{
	// Thanks to https://gist.github.com/milo/daed6e958ea534e4eba3

	/**
	 * @param Request $request
	 *
	 * @return string
	 */
	public function postWebHook(Request $request)
	{
		$signature = $request->header('X-Hub-Signature', NULL);

		if (!$signature) {
			return 'Missing signature';
		}

		list($algorithm, $expectedHash) = explode('=', $signature, 2) + ['', ''];

		if (!in_array($algorithm, hash_algos(), TRUE)) {
			return "Hash {$algorithm} not supported";
		}

		$rawPost = $request->getContent();
		$hookSecret = config('services.github.hook_secret');
		$current = hash_hmac($algorithm, $rawPost, $hookSecret);
		if (!hash_equals($current, $expectedHash)) {
			return 'Hook secret does not match';
		}

		$gitHubEvent = $request->header('X-GitHub-Event', NULL);
		if (!$gitHubEvent) {
			return 'Missing GitHub event';
		}

		switch (strtolower($gitHubEvent)) {
			case 'ping':
				return 'pong';
				break;
			case 'push':
				$process = new Process(
					'sh update.sh',
					base_path()
				);

				$process->start();

				return 'process started';
				break;
			default:
				return 'Unknown event';
		}
	}
}