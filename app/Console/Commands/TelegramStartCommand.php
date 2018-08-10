<?php

namespace App\Console\Commands;

use Telegram\Bot\Commands\Command;

class TelegramStartCommand extends Command
{
    protected $name = 'start';

	protected $description = "Get informed about this bot";

	/**
	 * Execute the console command.
	 *
	 * @param $arguments
	 */
    public function handle($arguments)
    {
	    $this->replyWithMessage([
	    	'text' => 'Hello! Welcome to the monitoring bot for Mavin.Rocks services. Please reply with your email address to sign-in.'
	    ]);
    }
}
