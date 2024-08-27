<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\User;
use App\Models\Interest;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

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
                    'status' => 'accepted',
                    'start_date' => now(),
                    'end_date' => now()->addDays(7),
                    'is_invited' => true,
                ]);
            }

            $Interets = Interest::inRandomOrder()->take(rand(1, 10))->get();
            foreach ($Interets as $interest) {
                $page->interests()->attach($interest->id);
            }

            $page->posts()->create([
                'uuid' => Str::uuid(),
                'user_id' => $page->user_id,
                'body' => 'Welcome to '.$page->name.' page',
            ]);
        });
    }
}
