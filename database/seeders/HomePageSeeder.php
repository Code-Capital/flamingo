<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homepage = HomePage::updateOrCreate(
            ['id' => 1], // Assuming you're updating the first row; adjust accordingly
            [
                'hero_heading' => 'Discover Flamingo - Where Vibrancy Meets Connections',
                'hero_description' => 'Discover a place where connections, friendships, and communities thrive. Flamingo is your gateway to an inclusive online space where you can interact, share, and engage with like-minded individuals. Join us to meet new people, explore shared interests, and connect with your community!',
                'hero_image' => 'assets/hero-image.png',

                'feature_heading' => 'Our features',
                'feature_description' => 'This is a simple feature description',
            ]
        );

        // Create a feature
        $homepage->features()->updateOrCreate(
            ['id' => 1], // Assuming you're updating the first row; adjust accordingly
            [
                'heading' => 'Profile Creation',
                'description' => 'Craft a vibrant, personalized profile to connect with like-minded individuals.',
                'image' => 'assets/icon1.svg',
            ]
        );

        // Create a feature
        $homepage->features()->updateOrCreate(
            ['id' => 2], // Assuming you're updating the first row; adjust accordingly
            [
                'heading' => 'Communicate & Connect',
                'description' => 'Engage actively, connect effortlessly, and build meaningful relationships with others',
                'image' => 'assets/icon2.svg',
            ]
        );

        // Create a feature
        $homepage->features()->updateOrCreate(
            ['id' => 3], // Assuming you're updating the first row; adjust accordingly
            [
                'heading' => 'Content Sharing',
                'description' => 'Share captivating stories, spark engaging conversations, and inspire others\' creativity.',
                'image' => 'assets/icon3.svg',
            ]
        );
    }
}
