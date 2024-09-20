<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Interest::factory()->count(100)->create();
        Interest::insert([
            [
                'name' => 'Art',
                'slug' => Str::slug('Art')
            ],
            [
                'name' => 'Business',
                'slug' => Str::slug('Business')
            ],
            [
                'name' => 'Education',
                'slug' => Str::slug('Education')
            ],
            [
                'name' => 'Engineering',
                'slug' => Str::slug('Engineering')
            ],
            [
                'name' => 'Health',
                'slug' => Str::slug('Health')
            ],
            [
                'name' => 'Law',
                'slug' => Str::slug('Law')
            ],
            [
                'name' => 'Science',
                'slug' => Str::slug('Science')
            ],
            [
                'name' => 'Technology',
                'slug' => Str::slug('Technology')
            ],
        ]);
    }
}
