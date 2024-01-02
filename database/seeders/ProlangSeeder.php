<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProlangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'kodeprolang' => 123,
                'prolang' => 'Semester Pendek',
                'Deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quam esse dicta dolore voluptas beatae aut ab repellendus. Sapiente magnam, illum quia libero voluptatem corrupti vero accusantium distinctio aliquam totam iste! Quibusdam, porro! Iste accusamus expedita eaque, rem dicta reprehenderit repudiandae qui recusandae optio asperiores distinctio vel autem obcaecati quia?',
                'harga' => 100000,
                'satuan' => 'per-SKS'
            ],
            [
                'kodeprolang' => 124,
                'prolang' => 'Semester Panjang',
                'Deskripsi' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quam esse dicta dolore voluptas beatae aut ab repellendus. Sapiente magnam, illum quia libero voluptatem corrupti vero accusantium distinctio aliquam totam iste! Quibusdam, porro! Iste accusamus expedita eaque, rem dicta reprehenderit repudiandae qui recusandae optio asperiores distinctio vel autem obcaecati quia?',
                'harga' => 20000,
                'satuan' => 'per-Matkul'

            ]
        ];

        foreach ($datas as $data) {
            DB::table('prolangs')->insert($data);
        }
    }
}
