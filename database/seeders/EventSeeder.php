<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory(1000)->create()->each(function ($event) {
            $interests = Interest::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random interests
            $event->interests()->attach($interests);

            $users = User::inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random admins
            $event->users()->attach($users);

            $users = User::role('user')->inRandomOrder()->take(rand(1, 3))->get(); // Attach 1 to 3 random users
            foreach ($users as $user) {
                $event->allMembers()->attach($user->id, [
                    'status' => $this->randomStatus(), // Assign random status to the pivot table
                ]);
            }

            $event->posts()->create([
                'uuid' => Str::uuid(),
                'user_id' => $event->user_id,
                'body' => 'Welcome to '.$event->name.' event',
            ]);
        });
    }

    private function randomStatus()
    {
        $statuses = ['pending', 'accepted', 'rejected'];

        return $statuses[array_rand($statuses)];
    }
}
