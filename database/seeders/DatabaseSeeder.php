<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\EventSeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\InterestSeeder;
use Database\Seeders\AnnouncementSeeder;

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
            UserSeeder::class,
            EventSeeder::class,
            AnnouncementSeeder::class,
        ]);
    }
}
