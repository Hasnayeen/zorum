<?php

namespace Database\Factories;

use App\Enums\ThreadStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Hub;
use App\Models\Tag;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Support\Arr;

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
            'status' => Arr::random(ThreadStatus::cases()),
            'published_at' => $this->faker->dateTime(),
            'user_id' => User::factory(),
            'hub_id' => Hub::factory(),
        ];
    }
}
