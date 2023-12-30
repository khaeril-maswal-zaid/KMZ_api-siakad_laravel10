<?php

namespace App\Http\Controllers;

use App\Http\Resources\rancanganstudi\RancanganStudiResource;
use App\Models\Mahasiswa;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\Rancangan_studi;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class RancanganStudiController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kodeprodi' => 'required|numeric',
            'nimmahasiswa' => 'required|numeric',
            'namamahasiswa' => 'required',
            "semester" => 'required|numeric|max:14|min:1',
            'kodematkul' => 'required|numeric|digits_between:7,7',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new RancanganStudiResource(422, $validator->errors(), null);
        }


        //Cek ketersediaan data
        //----------------------------------------------------------------------------------------
        $datamahasiswa = Mahasiswa::select('id', 'nama', 'prodi')->where('nim', $request->nimmahasiswa)->first();
        $dataprodi = Prodi::select('id', 'prodi_full')->where('kode_prodi', $request->kodeprodi)->first();
        $datamatkul = Matkul::select('id', 'prodi', 'matkul')->where('kode_matkul', $request->kodematkul)->first();

        if (!isset($datamahasiswa)) {
            return new RancanganStudiResource(422, "Mahasiswa tidak ditemukan!", null);
        }

        if (!isset($dataprodi)) {
            return new RancanganStudiResource(422, "Prodi tidak ditemukan!", null);
        }

        if (!isset($datamatkul)) {
            return new RancanganStudiResource(422, "Mata Kuliah tidak ditemukan!", null);
        }
        //-----------------------------------------------------------------------------------------


        //TERIMA DATA NIM DAN NAMA MAHASISWA
        //QUERY NIM KEMUDIAN HASILNYA SEIMBANGKAN DENGAN NAMA YANG DITERIMA
        if ($datamahasiswa['nama'] != $request->namamahasiswa) {
            return new RancanganStudiResource(422, "'nama' Error!", null);
        };


        $prodibymahasiswa = Prodi::select('prodi_full')->findOrFail($datamahasiswa['prodi']);
        $prodibymatkul = Prodi::select('id', 'prodi_full')->findOrFail($datamatkul['prodi']);

        //CEK PRODI HASRUS SAMA PRODI GET DENGAN PRODI MAHASISWA
        if ($dataprodi['id'] != $datamahasiswa['prodi'] || $prodibymatkul['id'] != $dataprodi['id']) {
            return new RancanganStudiResource(422, "Prodi tidak singkron", [
                "Prodi get" => $dataprodi['prodi_full'],
                "Prodi mahasiswa" => $prodibymahasiswa['prodi_full'],
                "Prodi matkul" => $prodibymatkul['prodi_full'],
            ]);
        }


        //Jangan biarkan SEMESTER dan KODE BIAYA duplicat
        if (Rancangan_studi
            ::where('mahasiswa', $datamahasiswa['id'])
            ->where('semester', $request->semester)
            ->where('matkul', $datamatkul['id'])
            ->exists()
        ) {
            return new RancanganStudiResource(422, "Data yang sama telah exsist", [
                "mahasiswa" => $datamahasiswa['nama'],
                "semester" => $request->semester,
                'matkul' => $datamatkul['matkul'],
            ]);
        }

        //PEROGRAM ULANG
        //Jangan biarkan SEMESTER dan KODE BIAYA duplicat
        if (Rancangan_studi
            ::where('mahasiswa', $datamahasiswa['id'])
            ->where('matkul', $datamatkul['id'])
            ->exists()
        ) {
            $programulang = true;
        } else {
            $programulang = false;
        }


        $post = Rancangan_studi::create([
            'prodi' => $dataprodi['id'],
            'mahasiswa' => $datamahasiswa['id'],
            'semester' => $request->semester,
            'matkul' =>  $datamatkul['id'],
            'programulang' => $programulang
        ]);

        //return response
        return new RancanganStudiResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }
}
