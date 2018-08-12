<?php

/**
 * Generate an unique telegram token for WebHook requests
 *
 * @return string
 */
function getTelegramToken()
{
	$botToken = config('telegram.bot_token');
	$appName = config('app.name');
	$environment = config('app.env');
	$appKey = config('app.key');

	return sha1($botToken . $appName . $environment . $appKey);
}