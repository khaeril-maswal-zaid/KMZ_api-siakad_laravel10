<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya_kuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        "prodi",
        "tahun_akademik",
        "semester",
        "jumlah",
        "jenis_biaya",
        "kode_biaya",
        "added_by",
    ];
}
