<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matkul>
 */
class MatkulFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "prodi" => fake()->numberBetween(1, 8),
            'matkul' => fake()->word(),
            'kode_matkul' => fake()->unique()->numberBetween(3104001, 9999999),
            'sks' => fake()->numberBetween(1, 5),
            "semester" => fake()->numberBetween(1, 14),
            "added_by" => 'Defaul',
        ];
    }
}
