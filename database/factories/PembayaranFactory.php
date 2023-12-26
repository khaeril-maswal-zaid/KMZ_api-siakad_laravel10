<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pembayaran>
 */
class PembayaranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_transaksi' => fake()->unique()->numberBetween(111111111, 999999999),
            'from_bank' => fake()->unique()->numberBetween(111111111, 999999999),
            'mahasiswa' => fake()->numberBetween(1, 50),
            'prodi' => fake()->numberBetween(1, 8),
            'total_biaya' => fake()->numberBetween(1, 14),
            'bayar' => 123456789,
            'sisa_bayar' => 123456789,
            'lunas' => fake()->boolean(),
            'added_by' => fake()->name()
        ];
    }
}
