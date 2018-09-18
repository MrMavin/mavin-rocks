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
        $signature = $request->header('X-Hub-Signature', null);

        if (! $signature) {
            return 'Missing signature';
        }

        list($algorithm, $expectedHash) = explode('=', $signature, 2) + [
            '',
            '',
        ];

        if (! in_array($algorithm, hash_algos(), true)) {
            return "Hash {$algorithm} not supported";
        }

        $rawPost = $request->getContent();
        $hookSecret = config('services.github.hook_secret');
        $current = hash_hmac($algorithm, $rawPost, $hookSecret);
        if (! hash_equals($current, $expectedHash)) {
            return 'Hook secret does not match';
        }

        $gitHubEvent = $request->header('X-GitHub-Event', null);
        if (! $gitHubEvent) {
            return 'Missing GitHub event';
        }

        switch (strtolower($gitHubEvent)) {
            case 'ping':
                return 'pong';
                break;
            case 'push':
                $environment = config('app.env');
                notifyAdmins("Push hook received, starting update. ({$environment})");

                $process = new Process('php artisan app:update', base_path());
                $process->start();

                return 'update queued';
                break;
            default:
                return 'Unknown event';
        }
    }
}