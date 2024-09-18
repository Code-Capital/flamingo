<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\Page;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::factory()->count(1000)->create()->each(function ($page) {
            $users = User::role('user')->inRandomOrder()->take(rand(1, 3))->get();
            foreach ($users as $user) {
                $page->users()->attach($user->id, [
                    'status' => 'accepted',
                    'start_date' => now(),
                    'end_date' => now()->addDays(7),
                    'is_invited' => true,
                ]);
            }

            $Interets = Interest::inRandomOrder()->take(rand(1, 3))->get();
            foreach ($Interets as $interest) {
                $page->interests()->attach($interest->id);
            }

            $page->posts()->create([
                'uuid' => Str::uuid(),
                'user_id' => $page->user_id,
                'body' => 'Welcome to ' . $page->name . ' page',
            ]);
        });
    }
}
