<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;

class BackupDatabase extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'backup:database';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Backups the application database';

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
	 */
	public function handle()
	{
		$this->getLogger()->info('Starting backups...');

		$backupPath = storage_path('backups/database');
		$maximumKeepTime = 60 * 24 * 7; // one week

		// check that our path exists, otherwise create it
		if (!\File::exists($backupPath)) {
			\File::makeDirectory($backupPath, 0775, TRUE);
		}

		// remove old backups
		$removeCmd = "find . -mmin {$maximumKeepTime} -delete";
		$this->runProcess($removeCmd, $backupPath);

		// make backup
		$fileName = Carbon::now()->format('d-m-Y@H-s');
		$host = config('database.connections.mysql.host');
		$user = config('database.connections.mysql.username');
		$password = config('database.connections.mysql.password');
		$database = config('database.connections.mysql.database');

		$dumpCmd = "mysqldump -u {$user} -p{$password} -h {$host} -r {$fileName}.sql {$database}";
		$this->runProcess($dumpCmd, $backupPath);

		// compress backup
		$compressCmd = "tar -czf {$fileName}.tar.gz {$fileName}.sql";
		$this->runProcess($compressCmd, $backupPath);

		// delete old sql file
		$deleteCmd = "rm {$fileName}.sql";
		$this->runProcess($deleteCmd, $backupPath);

		$this->getLogger()->info('Backup done.');
	}

	private function runProcess($cmd, $pwd)
	{
		$process = new Process($cmd, $pwd);
		$process->run();
		$process->wait();

		$exitCode = $process->getExitCode();

		if ($exitCode != 0) {
			$command = explode(" ", $process->getCommandLine())[0];

			$this->getLogger()
				->error("Command {$command} failed ({$exitCode})",
					[
						'errorOutput' => trim($process->getErrorOutput())
					]);

			return FALSE;
		}

		return TRUE;
	}

	/**
	 * @return LoggerInterface
	 */
	private function getLogger()
	{
		return \Log::channel('backups');
	}
}
