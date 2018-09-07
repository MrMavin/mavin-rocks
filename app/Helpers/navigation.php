<?php

/**
 * Check if the current route is active
 * Used for highlight in navigation links
 *
 * @param $routeName
 *
 * @return string
 */
function is_active($routeName)
{
	$currentRouteName = \Route::currentRouteName();
	return str_contains($currentRouteName, $routeName) ? 'is-active' : '';
}