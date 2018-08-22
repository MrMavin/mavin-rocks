<?php

namespace App\Console;

use App\Console\Commands\GenerateSitemap;
use App\Console\Commands\MakeUser;
use App\Console\Commands\TelegramSetUp;
use App\Console\Commands\UpdateApplication;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		GenerateSitemap::class,
		MakeUser::class,
		TelegramSetUp::class,
		UpdateApplication::class
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule $schedule
	 *
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('sitemap:generate')->twiceDaily();
	}

	/**
	 * Register the commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		$this->load(__DIR__ . '/Commands');

		require base_path('routes/console.php');
	}
}
