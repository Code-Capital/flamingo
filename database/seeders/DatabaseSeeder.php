<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Database\Seeders\LocationSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InterestSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            LocationSeeder::class,
            UserSeeder::class,
            EventSeeder::class,
            AnnouncementSeeder::class,
            PostSeeder::class,
            PageSeeder::class,
        ]);
    }
}
