<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'from_bank',
        'mahasiswa',
        'prodi',
        'total_biaya',
        'bayar',
        'sisa_bayar',
        'lunas',
        'added_by'
    ];
}
