<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nim', 'fakultas', 'prodi', 'nik', 'email', 'jk', 'tempat_lahir', 'tanggal_lahir', 'agama', 'nomor_hp', 'provinsi', 'kabupaten', 'kecamatan', 'desa', 'alamat', 'nama_ayah', 'nomor_hp_ayah', 'pekerjaan_ayah', 'penghasilan_ayah', 'nama_ibu', 'nomor_hp_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'jumlah_bersaudara', 'anak_ke', 'asal_sekolah', 'nisn', 'tahun_lulus', 'jurusan_sekolah', 'foto', 'angkatan', 'pull_by'];

    /**
     * Get the user that owns the Mahasiswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function pullbyG(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'pull_by', 'id');
    }

    public function prodiG(): BelongsTo
    {
        return $this->belongsTo(Prodi::class, 'prodi', 'id');
    }

    public function fakultasG(): BelongsTo
    {
        return $this->belongsTo(Fakultas::class, 'fakultas', 'id');
    }
}
