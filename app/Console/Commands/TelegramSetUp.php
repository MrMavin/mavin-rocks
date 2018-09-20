<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;

class TelegramSetUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup telegram web hook';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function handle()
    {
        if (config('app.env') !== 'production') {
            return;
        }

        /** @var Api $telegram */
        $telegram = app('telegram');

        $telegram->removeWebhook();

        $token = getTelegramToken();
        $url = route('webhooks.telegram', $token);

        $telegram->setWebhook([
                                  'url' => $url,
                              ]);
    }
}
