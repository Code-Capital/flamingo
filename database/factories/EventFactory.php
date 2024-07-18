<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'location' => $this->faker->address,
            'start_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'thumbnail' => null,
            'description' => $this->faker->paragraph,
            'status' =>  $this->faker->randomElement(['draft', 'published']),
        ];
    }
}
