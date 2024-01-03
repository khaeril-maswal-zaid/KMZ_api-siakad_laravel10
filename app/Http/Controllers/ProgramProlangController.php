<?php

namespace App\Http\Controllers;

use App\Http\Resources\biayaprolang\ProgramProlangResource;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Program_prolang;
use App\Models\Prolang;
use App\Models\Rancangan_studi;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class BiayaProlangController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodeprodi" => 'required|numeric',
            'tahunakademik' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
            'nimmahasiswa' => 'required|numeric',
            'namamahasiswa' => 'required',
            'kodeprogram' => 'required|numeric|digits_between:8,8',
            'kodeprolang' => 'required|numeric|digits_between:3,3',
            'added_by' => 'required',
        ]);


        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new ProgramProlangResource(422, $validator->errors(), null);
        }

        //--------------------------------------------------
        $datamahasiswa = Mahasiswa::select('id', 'nama', 'prodi')->where('nim', $request->nimmahasiswa)->first();
        $dataprodi = Prodi::select('id', 'prodi_full')->where('kode_prodi', $request->kodeprodi)->first();
        $dataprolang = Prolang::select('id', 'harga')->where('kode_prolang', $request->kodeprolang)->first();
        $dataprogram = Rancangan_studi::select('id', 'prodi', 'matkul')->where('kode_program', $request->kodeprogram)->first();

        if (!isset($datamahasiswa)) {
            return new ProgramProlangResource(404, "Mahasiswa tidak ditemukan!", null);
        }

        if (!isset($dataprodi)) {
            return new ProgramProlangResource(404, "Prodi tidak ditemukan!", null);
        }

        if (!isset($dataprolang)) {
            return new ProgramProlangResource(404, "Program Ulang tidak ditemukan!", null);
        }
        //--------------------------------------------------




        Program_prolang::create([
            'prodi' => $dataprodi['id'],
            'tahun_akademik' => $request->tahunakademik,
            'matkul' =>  $dataprogram['id'],
            'prolang' => $dataprolang['id'],
            'lunas' => true,
        ]);
    }
}
