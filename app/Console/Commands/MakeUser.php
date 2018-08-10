<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUser extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'make:user';

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
		$email = $this->ask('Please provide an email address');

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->error("You didn't provide a valid email address");
			return;
		}

		$user = User::whereEmail($email)->first();

		if ($user) {
			$this->error('User already exists');

			return;
		}

		if ($this->confirm("Do you wish to create an account named {$email}?")) {
			User::create([
				'email' => $email
			]);

			$this->info("Your account has been saved successfully");
		}

		return;
	}
}