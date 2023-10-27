<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedorFactory extends Factory
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
            "email" => $this->faker->unique()->safeEmail,
            "cnpj" => $this->faker->unique()->numberBetween(1, 10000)
        ];
    }
}
