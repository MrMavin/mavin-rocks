<?php

/**
 * Notify admins with a message on telegram
 *
 * @param $message
 */
function notifyAdmins($message)
{
	$users = \App\Models\User::all();

	foreach ($users as $user)
	{
		$user->sendTelegramMessage($message);
	}
}