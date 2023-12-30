<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi',
        'matkul',
        'kode_matkul',
        'sks',
        'semester',
        'added_by'
    ];
}
