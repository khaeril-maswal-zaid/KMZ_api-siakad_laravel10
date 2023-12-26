<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mahasiswa>
 */
class MahasiswaFactory extends Factory
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
            'nim' =>  fake()->randomNumber(9, true),
            'prodi' => fake()->numberBetween(1, 8),
            'fakultas' => fake()->numberBetween(1, 3),
            'nik' => fake()->randomNumber(9, true),
            'email' => fake()->safeEmail(),
            'nomor_hp' => fake()->phoneNumber(),
            'jk' => $jk[fake()->numberBetween(0, 1)],
            'tempat_lahir' => fake()->word(),
            'tanggal_lahir' => fake()->date('d-m-Y'),
            'agama' => 'Islam',
            'provinsi' => fake()->randomNumber(2, true),
            'kabupaten' => fake()->randomNumber(4, true),
            'kecamatan' => fake()->randomNumber(7, true),
            'desa' => fake()->randomNumber(9, true),
            'alamat' => fake()->address(),
            'nama_ayah' => fake()->name(),
            'nomor_hp_ayah' => fake()->phoneNumber(),
            'pekerjaan_ayah' => fake()->jobTitle(),
            'penghasilan_ayah' => '123.789',
            'nama_ibu' => fake()->name(),
            'nomor_hp_ibu' => fake()->phoneNumber(),
            'pekerjaan_ibu' => fake()->jobTitle(),
            'penghasilan_ibu' => '123.789',
            'jumlah_bersaudara' => fake()->randomNumber(2, true),
            'anak_ke' => fake()->randomNumber(2, true),
            'asal_sekolah' => 'SMA ' . fake()->word(),
            'nisn' => fake()->randomNumber(9, true),
            'tahun_lulus' => fake()->date('Y'),
            'jurusan_sekolah' => 'IPA',
            'foto' => fake()->name() . '_' . fake()->randomNumber() . '.png',
            'angkatan' => fake()->numberBetween(2010, 2023),
            'pull_by' => fake()->numberBetween(1, 2),
        ];
    }
}
