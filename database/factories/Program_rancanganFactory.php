<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program_rancangan>
 */
class Program_rancanganFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'angkatan' => fake()->numberBetween(2020, 2024),
            'kode_program' => fake()->numberBetween(11111111, 99999999),
            'prodi' => fake()->numberBetween(1, 8),
            'matkul' => fake()->numberBetween(1, 50),
            'added_by' => 'nama'
        ];
    }
}
