<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;

class UpdateApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the application';

    /**
     * Final message to send to admin
     *
     * @var string $message
     */
    private $message;

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
     * Execute the console command
     */
    public function handle()
    {
        $environment = config('app.env');
        $this->addNotification("Starting updating ($environment)...");

        // start maintenance mode
        $this->call('down');
        $this->addNotification('Application down...');

        // calculate fingerprints
        $composer = [
            base_path('composer.json'),
            base_path('composer.lock'),
        ];

        $npm = [
            base_path('package.json'),
            base_path('package-lock.json'),
        ];

        $assets = resource_path('assets');

        $composerHashBefore = $this->getHashFromFile($composer);
        $npmHashBefore = $this->getHashFromFile($npm);
        $assetsTreeHashBefore = $this->makeHash($this->getDirectoryTree($assets));

        // update git
        if (config('app.env') !== 'local') {
            $this->runProcess('git reset HEAD --hard');
        }
        $this->runProcess('git pull');

        $this->addNotification('Updated app...');

        // calculate fingerprints again
        $composerHashAfter = $this->getHashFromFile($composer);
        $npmHashAfter = $this->getHashFromFile($npm);
        $assetsTreeHashAfter = $this->makeHash($this->getDirectoryTree($assets));

        // clear compiled cache
        $this->call('clear-compiled');

        // composer dependencies have been updated
        if ($composerHashBefore !== $composerHashAfter) {
            $this->addNotification('Running composer install...');
            $this->runProcess('composer install');
        }

        // dumping composer auto-load
        $this->addNotification('Running composer dump-autoload...');
        $this->runProcess('composer dump-autoload');

        // npm dependencies have been updated
        if ($npmHashBefore !== $npmHashAfter) {
            $this->addNotification('Running npm install...');
            $this->runProcess('npm install');
        }

        // assets have been updated
        if ($assetsTreeHashBefore !== $assetsTreeHashAfter) {
            $this->addNotification('Running npm run...');
            $this->runProcess('npm run prod');
        }

        // clear everything
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('config:clear');
        $this->call('cache:clear');

        $this->addNotification('Cleared everything...');

        if (config('app.env') == 'production') {
            // cache everything
            $this->call('route:cache');
            $this->call('view:cache');
            $this->call('config:cache');

            // setup telegram hooks
            $this->call('telegram:setup');

            $this->addNotification('Production tasks...');
        }

        // remove maintenance mode
        $this->call('up');

        if (config('app.env') == 'production') {
            // sitemap must be generate after the UP command
            // otherwise it will be empty
            $this->call('sitemap:generate');
        }

        $this->addNotification('Up again...');

        //$this->runProcess('vendor/bin/phpunit');

        $this->addNotification('Done.');
        $this->pushNotification();
    }

    private function addNotification($message, $context = [])
    {
        $this->getLogger()->info($message, $context);
        $this->message .= $message.chr(10);
    }

    /**
     * @return LoggerInterface
     */
    private function getLogger()
    {
        return \Log::channel('updates');
    }

    private function getHashFromFile($file)
    {
        $content = '';

        if (is_array($file)) {
            foreach ($file as $f) {
                $content .= file_get_contents($f);
            }
        } else {
            $content = file_get_contents($file);
        }

        return $this->makeHash($content);
    }

    private function makeHash($content)
    {
        if (is_array($content)) {
            $content = json_encode($content);
        }

        return sha1($content);
    }

    private function getDirectoryTree($baseDirectory)
    {
        $files = [];

        $directories = scandir($baseDirectory);

        foreach ($directories as $directory) {
            if ($directory == '.' || $directory == '..') {
                continue;
            }

            $file = "{$baseDirectory}/$directory";

            if (is_dir($file)) {
                $files[$directory] = $this->getDirectoryTree($file);
            } else {
                if (is_file($file)) {
                    $size = filesize($file);
                    $files[] = "{$size}@{$file}";
                } else {
                    continue;
                }
            }
        }

        return $files;
    }

    private function runProcess($processCmd)
    {
        $process = new Process($processCmd, base_path());

        $process->run();
        $process->wait();

        $exitCode = $process->getExitCode();

        if ($exitCode != 0) {
            $this->addNotification("Process {$processCmd} failed ({$exitCode})", [
                                                                                   'errorOutput' => $process->getErrorOutput(),
                                                                               ]);
        }

        return $process->getExitCode();
    }

    private function pushNotification()
    {
        notifyAdmins($this->message);
    }
}
