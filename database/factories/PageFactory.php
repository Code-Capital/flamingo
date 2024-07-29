<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
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
            'name' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph,
            'is_private' => $this->faker->boolean,
            'cover_image' => null,
            'profile_image' => null,
            'user_id' => User::role('user')->inRandomOrder()->first()->id,
        ];
    }
}
