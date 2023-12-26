<?php

namespace App\Http\Controllers;

use App\Http\Resources\MahasiswaResource;
use App\Http\Resources\MahasiswaShowResource;

use App\Models\Mahasiswa;

use Illuminate\Http\Request;


class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        // return response()->json($mahasiswa);
        return MahasiswaResource::collection($mahasiswas);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa
            ::with('pullbyG:id,slug,name')
            ->with('fakultasG:id,fakultas,fakultas_full')
            ->with('prodiG:id,prodi,prodi_full')
            ->findOrFail($id);

        return new MahasiswaShowResource($mahasiswa);
    }

    public function shownim($nim)
    {
        $mahasiswa = Mahasiswa
            ::with('pullbyG:id,slug,name')
            ->with('fakultasG:id,fakultas,fakultas_full')
            ->with('prodiG:id,prodi,prodi_full')->where('nim', $nim)->first();

        return new MahasiswaShowResource($mahasiswa);
    }

    public function filer(string $key, string $value)
    {
        //CEK FILTER FALID
        $filter = ['fakultas', 'prodi', 'jk', 'provinsi', 'kabupaten', 'kecamatan', 'desa', 'tahun_lulus', 'angkatan'];
        if (!in_array($key, $filter)) {
            return response()->json([
                "status" => 404,
                "data" => [
                    "pesan" => "Key filter salah",
                ],
            ], 404);
        }

        $mahasiswas = Mahasiswa::all()->where($key, $value);
        // return response()->json($mahasiswa);
        return MahasiswaResource::collection($mahasiswas);
    }
}
