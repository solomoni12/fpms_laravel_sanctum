<?php

namespace Database\Factories;

use App\Models\Crop;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => Auth::user()->id,
            'field_id' => Field::all()->random()->id,
            'name' => $this->faker->unique()->setence(),
            'quantity' => $this->faker->text()
        ];
    }
}
