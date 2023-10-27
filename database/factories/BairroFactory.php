<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bairro>
 */
class BairroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name_neighborhood" => $this->faker->unique()->city,
            "cidade_id" => $this->faker->unique()->numberBetween(1, 5)
        ];
    }
}
