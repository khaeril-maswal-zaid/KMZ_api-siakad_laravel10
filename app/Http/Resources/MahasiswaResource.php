<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
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
            "nik" => $this->nik,
            "email" => $this->email,
            "jk" => $this->jk,
            "tanggal_lahir" => $this->tanggal_lahir,
            "agama" => $this->agama,
            "nomor_hp" => $this->nomor_hp,
            "kabupaten" => $this->kabupaten,
            "kecamatan" => $this->kecamatan,
            "nama_ayah" => $this->nama_ayah
        ];
    }
}
