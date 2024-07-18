<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Interest;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory(100)->create()->each(function ($event) {
            $interests = Interest::inRandomOrder()->take(rand(1, 10))->get(); // Attach 1 to 3 random interests
            $event->interests()->attach($interests);
        });
    }
}
