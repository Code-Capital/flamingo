<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Location::factory()->count(10)->create();
        Location::insert([
            [
                'name' => 'Lahore',
                'slug' => 'lahore',
            ],
            [
                'name' => 'Karachi',
                'slug' => 'karachi',
            ],
            [
                'name' => 'Islamabad',
                'slug' => 'islamabad',
            ],
            [
                'name' => 'Rawalpindi',
                'slug' => 'rawalpindi',
            ],
            [
                'name' => 'Faisalabad',
                'slug' => 'faisalabad',
            ],
            [
                'name' => 'Multan',
                'slug' => 'multan',
            ],
            [
                'name' => 'Peshawar',
                'slug' => 'peshawar',
            ],
            [
                'name' => 'Quetta',
                'slug' => 'quetta',
            ],
            [
                'name' => 'Gujranwala',
                'slug' => 'gujranwala',
            ],
            [
                'name' => 'Sialkot',
                'slug' => 'sialkot',
            ],
        ]);
    }
}
