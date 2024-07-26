<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        $admin = User::factory()->create([
            'first_name' => 'Test User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'user_name' => 'tester',
            'about' => 'Lorem Ipsum is simply dummy text of the printing er and typesetting industry. Lorem Ipsum has been Lorem Ipsum is simply dummy text of the printing er and typesetting industry. Lorem Ipsum has been Lorem Ipsum is simply dummy text of the printing er and typesetting industry. Lorem Ipsum has been Lorem Ipsum is simply dummy text of the printing er and typesetting industry.  Lorem Ipsum has been Lorem Ipsum is simply dummy text of the printing er and typesetting industry. Lorem Ipsum has been;',
            'is_private' => false,
        ]);
        $admin->assignRole('admin');
        $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
        $admin->interests()->attach($interests);

        $users = User::inRandomOrder()->take(rand(1, 500))->get();
        $admin->friends()->attach($users, ['status' => 'accepted']);

        // Create 10 regular users and attach random interests
        User::factory(100)->create()->each(function ($user) {
            $user->assignRole('user');

            // Attach random interests
            $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
            $user->interests()->attach($interests);

            // create friends
            $randomUsers = User::inRandomOrder()->take(rand(1, 10))->get();
            foreach ($randomUsers as $randomUser) {
                $user->friends()->attach($randomUser, ['status' => 'accepted']);
                $randomUser->friends()->attach($user, ['status' => 'accepted']);
            }
        });
    }
}
