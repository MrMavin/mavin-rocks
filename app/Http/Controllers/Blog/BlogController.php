<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogTag;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function getList()
    {
        $articles = BlogArticle::wherePublished(true)->orderByDesc('created_at')->paginate(3);

        return view('blog.list', ['articles' => $articles]);
    }

    /**
     * @param BlogArticle $article
     *
     * @return \Illuminate\View\View
     */
    public function getArticle(BlogArticle $article)
    {
        if (!$article->published)
            abort(404);

        return view('blog.article', ['article' => $article]);
    }

    /**
     * @param BlogCategory $category
     *
     * @return \Illuminate\View\View
     */
    public function getCategorySearch(BlogCategory $category)
    {
        $articles = BlogArticle::wherePublished(true)->orderByDesc('created_at')->whereCategoryId($category->id)->paginate(3);

        return view('blog.list', [
            'articles' => $articles,
            'category' => $category,
        ]);
    }

    /**
     * @param BlogTag $tag
     *
     * @return \Illuminate\View\View
     */
    public function getTagSearch(BlogTag $tag)
    {
        $articles = BlogArticle::wherePublished(true)->orderByDesc('created_at')->whereHas('tags',
            function ($query) use (
                $tag
            ) {
                $query->where('id', '=', $tag->id);
            })->paginate(3);

        return view('blog.list', [
            'articles' => $articles,
            'tag'      => $tag,
        ]);
    }
}