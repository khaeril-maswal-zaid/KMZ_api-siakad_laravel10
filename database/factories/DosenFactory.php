<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dosen>
 */
class DosenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jk = ['L', 'P'];

        return [
            'nama' => fake()->name(),
            'nidn' =>  fake()->randomNumber(9, true),
            'email' => fake()->safeEmail(),
            'nomor_hp' => fake()->phoneNumber(),
            'jk' => $jk[fake()->numberBetween(0, 1)],
            'tempat_lahir' => fake()->word(),
            'tanggal_lahir' => fake()->date('d-m-Y'),
            'alamat' => fake()->address(),
            'image' => 'image.png',
        ];
    }
}
