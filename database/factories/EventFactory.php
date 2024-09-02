<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = $this->faker->sentence;

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $title,
            'slug' => Str::slug($title),
            'location_id' => Location::inRandomOrder()->first()->id,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(3),
            'thumbnail' => null,
            'description' => $this->faker->paragraph,
            'rules' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['draft', 'published']),
        ];
    }
}
