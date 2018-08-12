<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'sitemap:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate the sitemap';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$url = config('app.url');
		$sitemapPath = public_path('sitemap.xml');

		SitemapGenerator::create($url)
			->hasCrawled(function (Url $url) {
				// http(s)://{$url}/{$firstLevel}/{$secondLevel}?{$params}
				$allowedFirstLevel = ['', 'about', 'skills', 'blog'];
				$disallowedParams = ['page='];

				$firstLevel = $url->segment(1);
				$uri = $url->url;

				if (!in_array($firstLevel, $allowedFirstLevel)) {
					return;
				}

				foreach($disallowedParams as $disallowed)
				{
					if (str_contains($uri, $disallowed)) {
						return;
					}
				}

				if ($url->segment(1) == NULL) { // Homepage
					$url->setPriority(1);
				}

				if (in_array($url->segment(1), ['about', 'skills'])) {
					$url->setPriority(1);
					$url->setChangeFrequency('weekly');
				}

				if ($url->segment(1) == 'blog') {
					$url->setChangeFrequency('daily');
					$url->setPriority(1);

					if ($url->segment(2) != NULL) { // Article, tag
						$url->setPriority(0.8);
					}
				}

				return $url;
			})
			->writeToFile($sitemapPath);
	}
}
