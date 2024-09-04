<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'sub_event_create_count' => 10,
            'un_sub_event_create_count' => 3,
            'sub_event_join_count' => 10,
            'un_sub_event_join_count' => 3,
            'sub_page_create_count' => 10,
            'un_sub_page_create_count' => 3,
            'sub_page_join_count' => 10,
            'un_sub_page_join_count' => 3,
        ]);
    }
}
