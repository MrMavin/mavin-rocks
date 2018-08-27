<?php

namespace App\Http\ViewComposers;

use App\Models\BlogArticle;
use App\Models\BlogTag;
use Illuminate\View\View;

class BlogSidebarComposer
{
	public static $blogTagsKey = 'blog_tags';
	public static $blogLatestKey = 'blog_latest';

	protected $tags;
	protected $latest;

	public function __construct()
	{
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
		$view->with('tags', $this->tags);
		$view->with('latest', $this->latest);
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
		\Cache::forget(self::$blogTagsKey);
		\Cache::forget(self::$blogLatestKey);
	}
}