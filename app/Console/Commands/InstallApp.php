<?php

namespace App\Console\Commands;

use App\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallApp extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'app:setup';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install basic stuffs for this app';
	
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
		$this->alert('Welcome to App Setup');
		$this->key();
		try {
			DB::connection()->getPDO();
			$this->migrate();
			$this->seed();
		} catch (Exception $e) {
			$this->warn('Please check database configurations before');
		}
		$this->info('Setup ended');
	}
	
	public function key(): void
	{
		$this->info('Generating new key');
		$this->callSilent('key:generate');
	}
	
	/**
	 * Migrate tables into database
	 */
	public function migrate(): void
	{
		$this->info('Migrating tables');
		if ($this->confirm('Would you like to migrate tables?')) {
			$this->call('migrate');
			$this->line('Migration completed');
		}
	}
	
	/**
	 * Seed generated tables
	 */
	public function seed(): void
	{
		$this->info('Seeding tables');
		if ($this->confirm('Do you need to seed tables?')) {
			$this->addUsers();
			$this->addAdmin();
			$this->line('Seed completed');
		}
	}
	
	/**
	 * Add users seed to database
	 */
	public function addUsers(): void
	{
		DB::table('users')->insert([
			'name'     => 'User',
			'email'    => 'user@mail.com',
			'password' => bcrypt('secret'),
		]);
		$this->comment('User inserted: [name: User, email: user@mail.com, password: secret]');
		factory(User::class, 5)->create();
	}
	
	/**
	 * Add administrator seed to database
	 */
	public function addAdmin(): void
	{
		DB::table('admins')->insert([
			'name'     => 'Admin',
			'email'    => 'admin@mail.com',
			'password' => bcrypt('secret'),
		]);
		$this->comment('Administrator inserted: [name: Admin, email: admin@mail.com, password: secret]');
		factory(User::class, 5)->create();
	}
}