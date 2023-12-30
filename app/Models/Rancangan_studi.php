<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rancangan_studi extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi',
        'mahasiswa',
        'semester',
        'matkul',
        'programulang'
    ];
}
