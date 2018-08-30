<?php

namespace App\Http\ViewComposers;

use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\View\View;

class BlogSidebarComposer
{
	public static $blogCategoriesKey = 'blog_categories';
	public static $blogTagsKey = 'blog_tags';
	public static $blogLatestKey = 'blog_latest';

	protected $categories;
	protected $tags;
	protected $latest;

	public function __construct()
	{
		$this->categories = \Cache::get(self::$blogCategoriesKey, false);

		if ($this->categories == false)
		{
			$this->categories = $this->__getCategories();
			\Cache::put(self::$blogCategoriesKey, $this->categories, 15);
		}

		$this->tags = \Cache::get(self::$blogTagsKey, false);

		if ($this->tags == false)
		{
			$this->tags = $this->__getMostUsedTags();
			\Cache::put(self::$blogTagsKey, $this->tags, 15);
		}

		$this->latest = \Cache::get(self::$blogLatestKey, false);

		if ($this->latest == false)
		{
			$this->latest = $this->__getLatestPosts();
			\Cache::put(self::$blogLatestKey, $this->latest, 15);

		}
	}

	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		$view->with('categories', $this->categories);
		$view->with('tags', $this->tags);
		$view->with('latest', $this->latest);
	}

	private function __getCategories()
	{
		return BlogCategory::select(['id', 'name', 'position'])
			->withCount('articles')
			->having('articles_count', '>', 0)
			->orderBy('position')
			->get()
			->toArray();
	}

	/**
	 * @return array
	 */
	private function __getMostUsedTags()
	{
		return BlogTag::select(['tag'])
			->withCount('articles')
			->having('articles_count', '>', 0)
			->orderByDesc('articles_count')
			->orderByDesc('id')
			->get()
			->toArray();
	}

	private function __getLatestPosts()
	{
		return BlogArticle::select(['id', 'title', 'created_at', 'slug'])
			->without('tags')
			->wherePublished(true)
			->orderByDesc('created_at')
			->take(3)
			->get()
			->toArray();
	}

	public static function clearSidebarCache()
	{
		\Cache::forget(self::$blogCategoriesKey);
		\Cache::forget(self::$blogTagsKey);
		\Cache::forget(self::$blogLatestKey);
	}
}