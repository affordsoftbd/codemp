<?php

use Illuminate\Database\Seeder;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = [
            ['district_name'=>'ঢাকা', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'ফরিদপুর', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'গাজীপুর', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'গোপালগঞ্জ', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'কিশোরগঞ্জ', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'মাদারীপুর', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'মানিকগঞ্জ', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'মুন্সিগঞ্জ', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'নারায়ণগঞ্জ', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'নরসিংদী', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'রাজবাড়ী', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'শরীয়তপুর', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'টাঙ্গাইল', 'division_id'=>'1', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'জামালপুর', 'division_id'=>'2', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'ময়মনসিংহ', 'division_id'=>'2', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'নেত্রকোনা', 'division_id'=>'2', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'শেরপুর', 'division_id'=>'2', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'বান্দরবান', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'ব্রাহ্মণবাড়িয়া', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'চাঁদপুর', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'চট্টগ্রাম', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'কুমিল্লা', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'কক্সবাজার', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'ফেনী', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'খাগড়াছড়ি', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'লক্ষ্মীপুর', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'নোয়াখালী', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'রাঙ্গামাটি', 'division_id'=>'3', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'বাগেরহাট', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'চুয়াডাঙ্গা', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'যশোর', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'ঝিনাইদহ', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'খুলনা', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'কুষ্টিয়া', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'মাগুরা', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'মেহেরপুর', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'নড়াইল', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'সাতক্ষীরা', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'বরগুনা', 'division_id'=>'5', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'বরিশাল', 'division_id'=>'5', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'ভোলা', 'division_id'=>'5', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'ঝালকাঠি', 'division_id'=>'5', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'পটুয়াখালী', 'division_id'=>'5', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'পিরোজপুর', 'division_id'=>'5', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'হবিগঞ্জ', 'division_id'=>'6', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")]],
            ['district_name'=>'মৌলভীবাজার', 'division_id'=>'6', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")]],
            ['district_name'=>'সুনামগঞ্জ', 'division_id'=>'6', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'সিলেট', 'division_id'=>'6', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],

            	// /

            ['district_name'=>'দিনাজপুর', 'division_id'=>'7', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'গাইবান্ধা', 'division_id'=>'7', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'কুড়িগ্রাম', 'division_id'=>'7', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'লালমনিরহাট', 'division_id'=>'7', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'নীলফামারী', 'division_id'=>'7', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'পঞ্চগড়', 'division_id'=>'7', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'রংপুর', 'division_id'=>'7', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            ['district_name'=>'Thakurgaon', 'division_id'=>'7', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")],
            /*['district_name'=>'সাতক্ষীরা', 'division_id'=>'4', 'created_at' => strftime("%Y-%m-%d %H:%M:%S"), 'updated_at' => strftime("%Y-%m-%d %H:%M:%S")]]*/
        ];

        
        DB::table("districts")->insert($districts);
    }
}
