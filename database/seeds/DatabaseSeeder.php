<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        	// Seed the countries
		$this->call('DivisionTableSeeder');
		$this->command->info('Seeded the divisions!');
    }
}
