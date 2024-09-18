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
            'first_name' => 'Admin',
            'last_name' => 'user',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'user_name' => 'admin',
            'about' => null,
            'is_private' => false,
        ]);

        $adminUser->assignRole(['user', 'admin']);
        $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
        $adminUser->interests()->attach($interests);
        $adminUser->userInfo()->create([
            'municipality' => 'Municipality',
        ]);

        // Create an simple user
        $simpleUser = User::factory()->create([
            'first_name' => 'M',
            'last_name' => 'arslan',
            'user_name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'about' => 'Lorem Ipsum is simply dummy text of the printing er and typesetting industry.',
            'is_private' => false,
        ]);
        $simpleUser->assignRole('user');
        $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
        $simpleUser->interests()->attach($interests);
        $simpleUser->userInfo()->create([
            'municipality' => 'Municipality',
        ]);

        // Create an simple user
        $simpleUser = User::factory()->create([
            'first_name' => 'user',
            'last_name' => '1',
            'user_name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('password'),
            'about' => 'Lorem Ipsum is simply dummy text of the printing er and typesetting industry.',
            'is_private' => false,
        ]);
        $simpleUser->assignRole('user');
        $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
        $simpleUser->interests()->attach($interests);
        $simpleUser->userInfo()->create([
            'municipality' => 'Municipality',
        ]);

        // Create an simple user
        $simpleUser = User::factory()->create([
            'first_name' => 'user',
            'last_name' => '2',
            'user_name' => 'user2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('password'),
            'about' => 'Lorem Ipsum is simply dummy text of the printing er and typesetting industry.',
            'is_private' => false,
        ]);
        $simpleUser->assignRole('user');
        $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
        $simpleUser->interests()->attach($interests);
        $simpleUser->userInfo()->create([
            'municipality' => 'Municipality',
        ]);

        $simpleUser = User::factory()->create([
            'first_name' => 'user',
            'last_name' => '3',
            'user_name' => 'user3',
            'email' => 'user3@gmail.com',
            'password' => Hash::make('password'),
            'about' => 'Lorem Ipsum is simply dummy text of the printing er and typesetting industry.',
            'is_private' => false,
        ]);
        $simpleUser->assignRole('user');
        $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
        $simpleUser->interests()->attach($interests);
        $simpleUser->userInfo()->create([
            'municipality' => 'Municipality',
        ]);

        // $users = User::inRandomOrder()->take(rand(1, 500))->get();
        // $simpleUser->friends()->attach($users, ['status' => 'accepted']);

        // // Create 10 regular users and attach random interests
        User::factory(100)->create()->each(function ($user) {

            $user->assignRole('user');

            // Create 10 posts for each user
            $user->posts()->createMany(Post::factory(5)->make()->toArray());

            // Attach random interests
            $interests = Interest::inRandomOrder()->take(rand(1, 2))->get(); // Attach 1 to 3 random interests
            $user->interests()->attach($interests);

            $user->userInfo()->create([
                'municipality' => null,
            ]);

            // create friends
            $randomUsers = User::inRandomOrder()->take(rand(1, 20))->get();

            $status = ['accepted', 'pending', 'rejected'];
            foreach ($randomUsers as $randomUser) {
                $user->friends()->attach($randomUser, ['status' => $status[array_rand($status)]]);
                $randomUser->friends()->attach($user, ['status' => $status[array_rand($status)]]);
            }
        });
    }
}
