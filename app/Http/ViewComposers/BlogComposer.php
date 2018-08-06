<?php

namespace App\Http\ViewComposers;

use App\Models\BlogTag;
use Illuminate\View\View;

class BlogComposer
{
	protected $tags;

	public function __construct()
	{
		$this->tags = BlogTag::select(['tag'])
		    ->withCount('articles')
			->orderBy('articles_count', 'DESC')
			->orderBy('id', 'DESC')
			->get()
			->toArray();

		// TODO cache
	}

	public function compose(View $view)
	{
		$view->with('tags', $this->tags);
	}
}