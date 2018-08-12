<?php

namespace App\Http\Controllers\WebHooks;

use App\Http\Controllers\Controller;
use App\Models\User;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class Telegram extends Controller
{
	/** @var Api $telegram */
	protected $telegram;

	public function __construct()
	{
		$this->telegram = app('telegram');
	}

	/**
	 * Process WebHook request
	 *
	 * @param $token
	 */
	public function postWebHook($token)
	{
		// Validate request token with app generate unique token
		if ($token !== getTelegramToken()) {
			// TODO bad token exception / logging
			return;
		}

		$this->telegram->commandsHandler(TRUE);

		/** @var Update $update */
		$update = \Telegram::getWebhookUpdates();

		$message = $update->getMessage();
		$chat = $message->getChat();

		$chatId = $chat->getId();
		$text = $message->getText();

		if (starts_with($text, '/')) { // Command, do not process
			return;
		}

		if (!filter_var($text, FILTER_VALIDATE_EMAIL)) {
			$this->telegram->sendMessage([
				'chat_id' => $chatId,
				'text' => 'Please provide a valid email.'
			]);

			return;
		}

		$user = User::whereEmail($text)->first();

		if (!$user) {
			$this->telegram->sendMessage([
				'chat_id' => $chatId,
				'text' => 'Your email is not eligible to receive status updates.'
			]);
		}

		$user->telegram_chat_id = $chatId;
		$user->save();

		$this->telegram->sendMessage([
			'chat_id' => $chatId,
			'text' => 'You will now receive status updates from the app.'
		]);
	}
}
