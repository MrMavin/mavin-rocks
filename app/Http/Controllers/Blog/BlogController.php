<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;

class BlogController extends Controller
{
	/**
	 * @return \Illuminate\View\View
	 */
	public function getList()
	{
		$articles = BlogArticle::wherePublished(TRUE)
			->orderByDesc('id')
			->paginate(3);

		return view('blog.list', ['articles' => $articles]);
	}

	/**
	 * @param BlogArticle $article
	 *
	 * @return \Illuminate\View\View
	 */
	public function getArticle(BlogArticle $article)
	{
		return view('blog.article', ['article' => $article]);
	}

	/**
	 * @param string $category
	 *
	 * @return \Illuminate\View\View
	 */
	public function getCategorySearch(string $category)
	{
		$articles = BlogArticle::wherePublished(TRUE)
			->orderByDesc('id')
			->whereCategoryId($category)
			->paginate(3);

		// clean category string
		$category = preg_replace('/[0-9\-]+/', '', $category);

		return view('blog.list', ['articles' => $articles, 'category' => $category]);
	}

	/**
	 * @param string $tag
	 *
	 * @return \Illuminate\View\View
	 */
	public function getTagSearch(string $tag)
	{
		$articles = BlogArticle::wherePublished(TRUE)
			->orderByDesc('id')
			->whereHas('tags', function ($query) use ($tag) {
				$query->where('tag', $tag);
			})
			->paginate(3);

		return view('blog.list', ['articles' => $articles, 'tag' => $tag]);
	}
}