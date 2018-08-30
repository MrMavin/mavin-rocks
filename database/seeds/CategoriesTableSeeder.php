<?php

use App\Models\BlogArticle;
use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
	public function run()
	{
		$names = [
			'Technology',
			'News',
			'Updates',
			'Travel'
		];

		for($i = 1; $i < count($names) + 1; $i++){
			BlogCategory::create([
				'name' => $names[$i - 1],
				'position' => $i
			]);
		}

		$articles = BlogArticle::all();
		$categories = BlogCategory::all();

		foreach($articles as $article) {
			$article->category_id = $categories->random()->id;
			$article->save();
		}
	}
}