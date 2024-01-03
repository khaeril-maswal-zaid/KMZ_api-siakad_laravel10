<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_rancangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'angkatan',
        'kode_program',
        'prodi',
        'matkul',
        'added_by',
    ];
}
