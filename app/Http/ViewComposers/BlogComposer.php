<?php

namespace App\Http\ViewComposers;

use App\Models\BlogTag;
use Illuminate\View\View;

class BlogComposer
{
	protected $tags;

	public function __construct()
	{
		$blogTagsKey = 'blog_tags';

		if (\Cache::has($blogTagsKey)){
			$this->tags = \Cache::get($blogTagsKey);
		}else{
			$this->tags = $this->__getMostUsedTags();
			\Cache::put($blogTagsKey, $this->tags, 15);
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
}