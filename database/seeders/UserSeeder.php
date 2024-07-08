<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'user_name' => 'tester',
        ]);
        $user->assignRole('admin');

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });
    }
}
