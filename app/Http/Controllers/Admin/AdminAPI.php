<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogArticleResource;
use App\Models\BlogArticle;

class AdminAPI extends Controller
{
	public function getArticles()
	{
		$articles = BlogArticle::with(['tags', 'category'])->get();
		return BlogArticleResource::collection($articles);
	}

	public function getArticle(BlogArticle $article)
	{
		return new BlogArticleResource($article);
	}
}