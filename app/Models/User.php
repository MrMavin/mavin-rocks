<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Telegram\Bot\Objects\Message;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $fillable = ['email'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(BlogArticle::class);
    }

    public function getApiKey()
    {
        $cacheKey = md5($this->attributes['id'] . $this->attributes['email']);
        $key = \Cache::get($cacheKey, null);

        if ($key == null){
            $key = sha1(str_random(32) . microtime());
            \Cache::put($cacheKey, $key, 60 * 24 * 30);
        }

        return $key;
    }

    /**
     * @param $message
     *
     * @return bool|Message
     */
    public function sendTelegramMessage($message)
    {
        if ($this->telegram_chat_id == 0) {
            return false;
        }

        $telegram = app('telegram');

        return $telegram->sendMessage([
                                          'chat_id' => $this->telegram_chat_id,
                                          'text'    => $message,
                                      ]);
    }
}
