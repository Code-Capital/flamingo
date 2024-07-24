<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Interest;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory(1000)->create()->each(function ($event) {
            $interests = Interest::inRandomOrder()->take(rand(1, 10))->get(); // Attach 1 to 3 random interests
            $event->interests()->attach($interests);

            $users = User::role('user')->inRandomOrder()->take(rand(1, 5))->get(); // Attach 1 to 3 random users
            foreach ($users as $user) {
                $event->allMembers()->attach($user->id, [
                    'status' => $this->randomStatus() // Assign random status to the pivot table
                ]);
            }
        });
    }


    private function randomStatus()
    {
        $statuses = ['pending', 'accepted', 'rejected'];
        return $statuses[array_rand($statuses)];
    }
}
