<?php

namespace App\Http\ViewComposers;

use App\Models\BlogTag;
use Illuminate\View\View;

class BlogComposer
{
	public static $blogTagsKey = 'blog_tags';

	protected $tags;

	public function __construct()
	{
		if (\Cache::has(self::$blogTagsKey)){
			$this->tags = \Cache::get(self::$blogTagsKey);
		}else{
			$this->tags = $this->__getMostUsedTags();
			\Cache::put(self::$blogTagsKey, $this->tags, 15);
		}
	}

	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		$view->with('tags', $this->tags);
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

	public static function clearMostUsedTags()
	{
		\Cache::forget(self::$blogTagsKey);
	}
}