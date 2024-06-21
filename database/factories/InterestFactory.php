<?php

namespace Database\Factories;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Interest>
 */
class InterestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $word = ucfirst($this->faker->unique()->word);
        return [
            'name' => $word,
            'slug' => Str::slug($word),
        ];
    }
}
