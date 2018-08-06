<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;

class BlogController extends Controller
{
	public function getList()
	{
		$articles = BlogArticle::wherePublished(TRUE)
			->orderByDesc('id')
			->paginate(3);

		return view('blog.list', ['articles' => $articles]);
	}

	public function getArticle(BlogArticle $article)
	{
		return view('blog.article', ['article' => $article]);
	}

	public function getTagsSearch(string $tag)
	{
		$articles = BlogArticle::wherePublished(TRUE)
			->orderByDesc('id')
			->whereHas('tags', function ($query) use ($tag) {
				$query->where('tag', $tag);
			})
			->paginate(3);

		return view('blog.list', ['articles' => $articles, 'filters' => ['tag' => $tag]]);
	}
}