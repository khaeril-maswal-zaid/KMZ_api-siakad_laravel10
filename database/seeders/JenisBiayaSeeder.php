<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisBiayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'jenis_biaya' => 'BPP',
                'kode_jenis' => '777',
                'added_by' => 'default'
            ],
            [
                'jenis_biaya' => 'KRU',
                'kode_jenis' => '778',
                'added_by' => 'default'
            ],
            [
                'jenis_biaya' => 'INFAQ',
                'kode_jenis' => '779',
                'added_by' => 'default'
            ],
            [
                'jenis_biaya' => 'SIAKAD',
                'kode_jenis' => '780',
                'added_by' => 'default'
            ],
        ];

        foreach ($datas as $data) {
            DB::table('jenis_biayas')->insert($data);
        }
    }
}
