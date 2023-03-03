<?php

namespace Database\Factories;

use app\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field>
 */
class FieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'name' => $this->faker->unique()->setence(),
            'location' => $this->faker->text(),
            'size' => $this->faker->randomElement(['low','medium','high'])
        ];
    }
}
