<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => $this->faker->unique()->name,
            "company_name" => $this->faker->unique()->company,
            "cnpj" => $this->faker->unique()->numberBetween(1, 10000),
            "vendedor_id" => $this->faker->unique()->numberBetween(1, 5)
        ];
    }
}
