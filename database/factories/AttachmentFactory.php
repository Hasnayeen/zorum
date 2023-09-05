<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Attachable;
use App\Models\Attachment;
use App\Models\User;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'path' => $this->faker->word,
            'user_id' => User::factory(),
            'attachable_id' => Attachable::factory(),
            'attachable_type' => $this->faker->word,
        ];
    }
}
