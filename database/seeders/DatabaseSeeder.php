<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\HubUserStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Guset User',
            'email' => 'guest@example.com',
            'password' => bcrypt('11111111'),
        ]);

        if (app()->environment('local')) {
            $hubs = \App\Models\Hub::factory(5)->create();

            \App\Models\User::factory(5)
                ->hasAttached($hubs, ['status' => HubUserStatus::Owner])
                ->create();
            $users = \App\Models\User::all();

            $tags = \App\Models\Tag::factory(10)->create([
                'user_id' => $users->random()->id,
                'hub_id' => $users->random()->hubs->random()->id,
            ]);

            $tags->each(function ($tag) {
                \App\Models\Channel::factory(10)->create([
                    'hub_id' => $tag->hub->id,
                    'tag_id' => $tag->id,
                ]);
            });

            \App\Models\Thread::factory(50)->create([
                'hub_id' => \App\Models\Hub::all()->random()->id,
            ])->each(function ($thread) use ($tags) {
                $thread->tags()->attach(
                    $tags->random(rand(1, 3))->pluck('id')->toArray()
                );
            });
        }
    }
}
