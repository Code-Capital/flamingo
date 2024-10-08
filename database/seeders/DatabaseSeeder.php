<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            HomePageSeeder::class,
            InterestSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            CountySeeder::class,
            StateSeeder::class,
            PermissionSeeder::class,
            SettingSeeder::class,
            LocationSeeder::class,
            UserSeeder::class,

            // EventSeeder::class,
            // AnnouncementSeeder::class,
            // PostSeeder::class,
            // PageSeeder::class,
            // SubscriberSeeder::class,
        ]);
    }
}
