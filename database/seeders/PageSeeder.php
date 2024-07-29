<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::factory()->count(100)->create()->each(function ($page) {
            $users = User::role('user')->inRandomOrder()->take(rand(1, 10))->get();
            foreach ($users as $user) {
                $page->users()->attach($user->id, [
                    'start_date' => now(),
                    'end_date' => now()->addDays(7),
                    'is_invited' => true,
                ]);
            }
        });
    }
}
