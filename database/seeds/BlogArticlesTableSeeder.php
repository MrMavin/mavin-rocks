<?php

use App\Models\BlogArticle;
use Illuminate\Database\Seeder;

class BlogArticlesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$articles = factory(BlogArticle::class, 10)->create();

		$avaiableTags = [
			'supercazzola',
			'prematurata',
			'sperdura',
			'cappotta',
			'anfioca',
			'prefettura',
			'tarapia',
			'tapioco'
		];

		/** @var BlogArticle $article */
		foreach ($articles as $article) {
			$tags = array_random($avaiableTags, rand(1, 4));
			$tagCollection = collect();

			foreach ($tags as $tag) {
				$tagCollection->push(\App\Models\BlogTag::firstOrNew(['tag' => $tag]));
			}

			$article->tags()->saveMany($tagCollection);
		}
	}
}