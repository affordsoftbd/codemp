<?php

use Illuminate\Database\Seeder;

class DivisionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $divisions = [
            ['division_name'=>'ঢাকা', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['division_name'=>'ময়মনসিংহ', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['division_name'=>'চট্টগ্রাম', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['division_name'=>'খুলনা', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['division_name'=>'বরিশাল', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['division_name'=>'সিলেট', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['division_name'=>'রংপুর', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['division_name'=>'রাজশাহী', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")]
        ];

        
        DB::table("divisions")->insert($divisions);
    }
}
