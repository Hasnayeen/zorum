<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Reactable;
use App\Models\Reaction;
use App\Models\User;

class ReactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'user_id' => User::factory(),
            'reactable_id' => Reactable::factory(),
            'reactable_type' => $this->faker->word,
        ];
    }
}
