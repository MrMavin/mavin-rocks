<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Telegram\Bot\Objects\Message;

class User extends Authenticatable
{
	use Notifiable;

	public $timestamps = FALSE;
	protected $fillable = ['email'];

	public function articles()
	{
		return $this->hasMany(BlogArticle::class);
	}

	/**
	 * @param $message
	 *
	 * @return bool|Message
	 */
	public function sendTelegramMessage($message)
	{
		if ($this->telegram_chat_id == 0) {
			return FALSE;
		}

		$telegram = app('telegram');

		return $telegram->sendMessage([
			'chat_id' => $this->telegram_chat_id,
			'text' => $message
		]);
	}
}
