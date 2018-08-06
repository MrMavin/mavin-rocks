<?php

function is_active($routeName)
{
	$currentRouteName = \Route::currentRouteName();
	return str_contains($currentRouteName, $routeName) ? 'is-active' : '';
}