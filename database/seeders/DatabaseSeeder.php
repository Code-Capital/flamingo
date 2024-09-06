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
            InterestSeeder::class,
            RoleSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            PermissionSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            LocationSeeder::class,
            SettingSeeder::class,
            UserSeeder::class,
            // EventSeeder::class,
            // AnnouncementSeeder::class,
            // PostSeeder::class,
            // PageSeeder::class,
            // SubscriberSeeder::class,
        ]);
    }
}
