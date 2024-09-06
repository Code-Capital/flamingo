<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::factory()->create([
            'first_name' => 'admin',
            'last_name' => 'user',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'user_name' => 'admin',
            'about' => null,
            'is_private' => false,
        ]);

        $adminUser->assignRole(['user', 'admin']);
        $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests

        // Create an admin user
        $simpleUser = User::factory()->create([
            'first_name' => 'muhammad',
            'last_name' => 'arslan',
            'user_name' => 'tester',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'about' => 'Lorem Ipsum is simply dummy text of the printing er and typesetting industry.',
            'is_private' => false,
        ]);
        $simpleUser->assignRole('user');
        $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
        $simpleUser->interests()->attach($interests);

        // $users = User::inRandomOrder()->take(rand(1, 500))->get();
        // $simpleUser->friends()->attach($users, ['status' => 'accepted']);

        // // Create 10 regular users and attach random interests
        // User::factory(25)->create()->each(function ($user) {

        //     $user->assignRole('user');

        //     // Create 10 posts for each user
        //     $user->posts()->createMany(Post::factory(5)->make()->toArray());

        //     // Attach random interests
        //     $interests = Interest::inRandomOrder()->take(rand(1, 2))->get(); // Attach 1 to 3 random interests
        //     $user->interests()->attach($interests);

        //     // create friends
        //     $randomUsers = User::inRandomOrder()->take(rand(1, 5))->get();
        //     foreach ($randomUsers as $randomUser) {
        //         $user->friends()->attach($randomUser, ['status' => 'accepted']);
        //         $randomUser->friends()->attach($user, ['status' => 'accepted']);
        //     }
        // });
    }
}
