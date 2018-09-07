<?php

use App\Http\ViewComposers\BlogSidebarComposer;
use App\Models\BlogArticle;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogTablesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(BlogCategory::class, 6)->create();
		factory(BlogTag::class, 12)->create();
		factory(BlogArticle::class, 25)->create();

		BlogSidebarComposer::clearSidebarCache();
	}
}