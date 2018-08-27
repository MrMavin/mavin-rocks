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

/**
 * @param \App\Models\BlogArticle|array $article
 *
 * @return string
 */
function get_article_url($article)
{
	if (is_array($article))
	{
		$id = $article['id'];
		$slug = $article['slug'];
	}else{
		$id = $article->id;
		$slug = $article->slug;
	}

	return $id . '-' . $slug;
}