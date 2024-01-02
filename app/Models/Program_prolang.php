<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_prolang extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi',
        'tahun_akademik',
        'mahasiswa',
        'matkul',
        'prolang',
        'lunas',
    ];
}
