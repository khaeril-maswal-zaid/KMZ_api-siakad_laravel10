<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            "id" => $this->id,
            "nama" => $this->nama,
            "nim" => $this->nim,
            "prodi" => $this->prodiG,
            "fakultas" => $this->fakultasG,
            "nik" => $this->nik,
            "email" => $this->email,
            "jk" => $this->jk,
            "tempat_lahir" => $this->tempat_lahir,
            "tanggal_lahir" => $this->tanggal_lahir,
            "agama" => $this->agama,
            "nomor_hp" => $this->nomor_hp,
            "provinsi" => $this->provinsi,
            "kabupaten" => $this->kabupaten,
            "kecamatan" => $this->kecamatan,
            "desa" => $this->desa,
            "alamat" => $this->alamat,
            "nama_ayah" => $this->nama_ayah,
            "nomor_hp_ayah" => $this->nomor_hp_ayah,
            "pekerjaan_ayah" => $this->pekerjaan_ayah,
            "penghasilan_ayah" => $this->penghasilan_ayah,
            "nama_ibu" => $this->nama_ibu,
            "nomor_hp_ibu" => $this->nomor_hp_ibu,
            "pekerjaan_ibu" => $this->pekerjaan_ibu,
            "penghasilan_ibu" => $this->penghasilan_ibu,
            "jumlah_bersaudara" => $this->jumlah_bersaudara,
            "anak_ke" => $this->anak_ke,
            "asal_sekolah" => $this->asal_sekolah,
            "nisn" => $this->nisn,
            "tahun_lulus" => $this->tahun_lulus,
            "jurusan_sekolah" => $this->jurusan_sekolah,
            "foto" => $this->foto,
            "pull_by" => $this->pullbyG,
            "created_at" => $this->created_at,
            "updted_at" => $this->updted_at
        ];
    }
}
