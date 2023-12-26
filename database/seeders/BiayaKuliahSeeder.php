<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class BiayaKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        \App\Models\Biaya_kuliah::factory(15)->create();
    }
    //Run : php artisan db:seed --class=BiayaKuliahSeeder
}
