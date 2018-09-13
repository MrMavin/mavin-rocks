<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminManageArticleRequest;
use App\Http\Resources\BlogArticleResource;
use App\Http\Resources\BlogCategoryResource;
use App\Models\BlogArticle;
use App\Models\BlogCategory;

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

	public function postArticle(AdminManageArticleRequest $articleRequest, BlogArticle $article)
	{
		$data = $articleRequest->only($article->getFillable());

		$article->update($data);
	}

	public function getCategories()
	{
		$categories = BlogCategory::orderBy('position')->get();
		return BlogCategoryResource::collection($categories);
	}
}