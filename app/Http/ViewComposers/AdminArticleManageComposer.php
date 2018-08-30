<?php

namespace App\Http\ViewComposers;

use App\Models\BlogCategory;
use Illuminate\View\View;

class AdminArticleManageComposer
{
	protected $categories;

	public function __construct()
	{
		$this->categories = BlogCategory::orderBy('position')
			->get()
			->toArray();
	}

	/**
	 * @param View $view
	 */
	public function compose(View $view)
	{
		$view->with('categories', $this->categories);
	}
}