<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Biaya_kuliah>
 */
class Biaya_kuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //KODE BAYAR----------
        //23 : Tahun
        //701 : Kode Fakultas
        //3101 : Kode Prodi
        //1 // Semester
        //1 // Ganjil / Genap

        $tahun = fake()->numberBetween(2020, 2024);

        return [
            "prodi" => fake()->numberBetween(1, 8),
            "tahun_akademik" => $tahun . '/' . $tahun + 1,
            "semester" => fake()->numberBetween(1, 14),
            "jumlah" => 12345678,
            "kode_biaya" => fake()->numberBetween(11111111111, 99999999999),
            "jenis_biaya" => fake()->numberBetween(1, 4),
            "added_by" => 'Defaul',
        ];
    }
}
