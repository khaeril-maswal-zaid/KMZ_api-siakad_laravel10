<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'id_fakultas' => 1,
                'kode_prodi' => 3104,
                'prodi_full' => 'PENDIDIKAN BAHASA INGGRIS',
                'prodi' => 'PBING',
                'kaprodi' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'id_fakultas' => 1,
                'kode_prodi' => 3103,
                'prodi_full' => 'PENDIDIKAN BAHASA INDONESIA',
                'prodi' => 'PBI',
                'kaprodi' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'id_fakultas' => 1,
                'kode_prodi' => 3102,
                'prodi_full' => 'PENDIDIKAN NON FORMAL',
                'prodi' => 'PNF',
                'kaprodi' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'id_fakultas' => 1,
                'kode_prodi' => 3101,
                'prodi_full' => 'PENDIDIKAN BIOLOGI',
                'prodi' => 'PBIO',
                'kaprodi' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'id_fakultas' => 2,
                'kode_prodi' => 3105,
                'prodi_full' => 'AKTUARIA',
                'prodi' => 'AKTUARIA',
                'kaprodi' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'id_fakultas' => 2,
                'kode_prodi' => 3106,
                'prodi_full' => 'KIMIA',
                'prodi' => 'KIMIA',
                'kaprodi' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'id_fakultas' => 2,
                'kode_prodi' => 3107,
                'prodi_full' => 'PETERNAKAN',
                'prodi' => 'PTR',
                'kaprodi' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'id_fakultas' => 3,
                'kode_prodi' => 3108,
                'prodi_full' => 'PERENCANAAN WILAYAH DAN KOTA',
                'prodi' => 'PWK',
                'kaprodi' => random_int(1, 9),
                'added_by' => 'default'
            ],
        ];

        foreach ($datas as $data) {
            DB::table('prodis')->insert($data);
        }

        //Run : php artisan db:seed --class=ProdiSeeder
    }
}
