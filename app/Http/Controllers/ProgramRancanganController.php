<?php

namespace App\Http\Controllers;

use App\Http\Resources\programrancangan\ProgramRancanganResource;
use App\Models\Matkul;
use App\Models\Prodi;
use App\Models\Program_rancangan;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ProgramRancanganController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'angkatan' => 'required|numeric|digits_between:4,4',
            'kodeprodi' => 'required|numeric|digits_between:4,4',
            'kodematkul' => 'required|numeric|digits_between:7,7',
            'added_by' => 'required',
        ]);


        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new ProgramRancanganResource(422, $validator->errors(), null);
        }

        //Cek prodi
        $dataprodi = Prodi::select('id', 'prodi_full')->where('kode_prodi', $request->kodeprodi)->first();
        if (!isset($dataprodi)) {
            return new ProgramRancanganResource(422, "Prodi tidak ditemukan!", null);
        }

        //Cek prodi
        $datamatkul = Matkul::select('id', 'prodi')->where('kode_matkul', $request->kodematkul)->first();
        if (!isset($datamatkul)) {
            return new ProgramRancanganResource(422, "Mata Kuliah tidak ditemukan!", null);
        }


        $prodibymatkul = Prodi::select('prodi_full')->findOrFail($datamatkul['prodi']);

        //CEK PRODI HASRUS SAMA PRODI GET DENGAN PRODI MAHASISWA
        if ($dataprodi['id'] != $datamatkul['prodi']) {
            return new ProgramRancanganResource(422, "Prodi tidak singkron", [
                "Prodi get" => $dataprodi['prodi_full'],
                "Prodi matkul" => $prodibymatkul['prodi_full'],
            ]);
        }

        //Kode Program => Angkatan + Kode Matkul
        $kodeprogram = $request->angkatan . $request->kodematkul;


        //Jangan biarkan data Exist
        if (Program_rancangan
            ::where('angkatan', $request->angkatan)
            ->where('kode_program', $kodeprogram)
            ->where('matkul', $datamatkul['id'])
            ->exists()
        ) {
            return new ProgramRancanganResource(422, "Data yang sama telah exsist", [
                'angkatan' > $request->angkatan,
                'kodeprogram' => $kodeprogram,
                'matkul' => $datamatkul['matkul'],
            ]);
        }

        $post = Program_rancangan::create([
            'angkatan' => $request->angkatan,
            'kode_program' => $kodeprogram,
            'prodi' => $dataprodi['id'],
            'matkul' => $datamatkul['id'],
            'added_by' => 'required',
        ]);

        //return response
        return new ProgramRancanganResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }
}
