<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'kode_fakultas' => 701,
                'fakultas_full' => 'FAKULTAS KEGURUAN DAN ILMU PENDIDIKAN',
                'fakultas' =>  'FKIP',
                'dekan' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'kode_fakultas' => 702,
                'fakultas_full' => 'FAKULTAS SAINS',
                'fakultas' =>  'FS',
                'dekan' => random_int(1, 9),
                'added_by' => 'default'
            ],
            [
                'kode_fakultas' => 703,
                'fakultas_full' => 'FAKULTAS TEKNIK',
                'fakultas' =>  'FT',
                'dekan' => random_int(1, 9),
                'added_by' => 'default'
            ],
        ];

        foreach ($datas as $data) {
            DB::table('fakultass')->insert($data);
        }

        //Run : php artisan db:seed --class=FakultasSeeder
    }
}
