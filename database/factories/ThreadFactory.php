<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Hub;
use App\Models\Tag;
use App\Models\Thread;
use App\Models\User;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thread::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'body' => $this->faker->text,
            'status' => $this->faker->word,
            'published_at' => $this->faker->dateTime(),
            'user_id' => User::factory(),
            'hub_id' => Hub::factory(),
            'tag_id' => Tag::factory(),
        ];
    }
}
