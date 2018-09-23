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
        	// Seed the divisions
		// $this->call('DivisionTableSeeder');
		// $this->command->info('Seeded the divisions!');

			// Seed the districts
		$this->call('DistrictTableSeeder');
		$this->command->info('Seeded the districts!');
    }
}
