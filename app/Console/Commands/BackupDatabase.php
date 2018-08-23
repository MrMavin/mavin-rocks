<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
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
     *
     */
    public function handle()
    {
        $backupPath = storage_path('backups/database');
		$maximumKeepTime = 60 * 24 * 7; // one week

        // check that our path exists, otherwise create it
        if (!\File::exists($backupPath))
            \File::makeDirectory($backupPath, 0775, true);

        // remove old backups
	    $removeCmd = "find . -mmin {$maximumKeepTime} -delete";
	    $process = new Process($removeCmd, $backupPath);
        $process->run();

        // make backup
	    $fileName = Carbon::now()->format('d-m-Y@H-s');
	    $host = config('database.connections.mysql.host');
	    $user = config('database.connections.mysql.username');
	    $password = config('database.connections.mysql.password');
	    $database = config('database.connections.mysql.database');

	    $dumpCmd = "mysqldump -u {$user} -p{$password} -h {$host} -r {$fileName}.sql {$database}";
	    $process = new Process($dumpCmd, $backupPath);
	    $process->run();

	    // compress backup
	    $compressCmd = "tar -czf {$fileName}.tar.gz {$fileName}.sql";
	    $process = new Process($compressCmd, $backupPath);
	    $process->run();

	    // delete old sql file
	    $deleteCmd = "rm {$fileName}.sql";
	    $process = new Process($deleteCmd);
	    $process->run();
    }
}
