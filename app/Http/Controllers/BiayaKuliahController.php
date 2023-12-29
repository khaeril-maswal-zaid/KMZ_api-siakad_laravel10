<?php

namespace App\Http\Controllers;

use App\Models\Biaya_kuliah;
use App\Http\Requests\UpdateBiaya_kuliahRequest;
use App\Http\Resources\BiayaKuliahResource;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;


class BiayaKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json('ok');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "kodeprodi" => 'required|numeric',
            'tahun_akademik' => ['required', 'regex:/^\d{4}\/\d{4}$/'],
            "semester" => 'required|numeric|max:14|min:1',
            "jumlah" => 'required|numeric|min:100000',
            // "kode_bayar" => 'required|numeric|digits_between:11,11|unique:biaya_kuliahs',
            "added_by" => 'required|max:250'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new BiayaKuliahResource(422, $validator->errors(), null);
        }

        $dataprodi = Prodi::select('id', 'id_fakultas', 'prodi_full')->where('kode_prodi', $request->kodeprodi)->first();
        if (!isset($dataprodi)) {
            return new BiayaKuliahResource(404, "Prodi tidak ditemukan!", null);
        }


        //KODE BAYAR----------
        //Pola : 2 digit terakhir Tahun + Kode Fakultas + Kode Prodi + Semester ke + Semester Ganjil / Genap
        //Contoh : 23+701+3104+7+1
        // => 23701310471

        $kodefakultas = Fakultas::select('kode_fakultas')->where('id', $dataprodi['id_fakultas'])->get()->value('kode_fakultas');
        $kodebayar = date('y') . $kodefakultas . $request->kodeprodi . $request->semester . $request->semester % 2;

        //Jangan biarkan SEMESTER dan KODE BIAYA duplicat
        if (Biaya_kuliah::where('tahun_akademik', $request->tahun_akademik)
            ->where('semester', $request->semester)
            ->where('kode_bayar', $kodebayar)
            ->exists()
        ) {
            return new BiayaKuliahResource(422, "Data yang sama telah exsist", [
                "Prodi: " . $dataprodi['prodi_full'],
                "Tahun Akademik: " .  $request->tahun_akademik,
                'Semister: ' . $request->semester,
            ]);
        }

        //create post
        $post = Biaya_kuliah::create([
            "prodi" => $dataprodi['id'],
            'tahun_akademik' => $request->tahun_akademik,
            "semester" => $request->semester,
            'jumlah' => $request->jumlah,
            'kode_bayar' => $kodebayar,
            'added_by' => $request->added_by,
        ]);

        //return response
        return new BiayaKuliahResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Biaya_kuliah $biaya_kuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Biaya_kuliah $biaya_kuliah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateBiaya_kuliahRequest $request, Biaya_kuliah $biaya_kuliah)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Biaya_kuliah $biaya_kuliah)
    {
        //
    }
}
