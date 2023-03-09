<?php

namespace Database\Factories;

use App\Models\Field;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crop>
 */
class CropFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'field_id' => Field::all()->random()->id,
            'crop_type' => $this->faker->unique()->setence(),
            'planting_date' => $this->faker->date(),
            'harvest_date' => $this->faker->date()
        ];
    }
}
