<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            DosenSeeder::class,
            FakultasSeeder::class,
            ProdiSeeder::class,
            AdminSeeder::class,
            MahasiswaSeeder::class,
            JenisBiayaSeeder::class,
            BiayaKuliahSeeder::class,
            PembayaranSeeder::class,
            MatkulSeeder::class,
            ProgramRancanganSeeder::class,
            ProlangSeeder::class,
        ]);

        //Run ALL : php artisan db:seed --class=DatabaseSeeder

    }
}
