<?php

namespace App\Http\Controllers;

use App\Http\Resources\matkul\MatkulResource;
use App\Models\Matkul;
use App\Models\Prodi;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class MatkulController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kodeprodi' => 'required|numeric',
            'matkul' => 'required',
            'sks' => 'required|numeric|digits_between:1,2|min:1|max:25',
            "semester" => 'required|numeric|max:14|min:1',
            'added_by' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new MatkulResource(422, $validator->errors(), null);
        }

        //Cek prodi
        $dataprodi = Prodi::select('id', 'prodi_full')->where('kode_prodi', $request->kodeprodi)->first();
        if (!isset($dataprodi)) {
            return new MatkulResource(422, "Prodi tidak ditemukan!", null);
        }


        //Cek Data telah exsis
        if (Matkul
            ::where('prodi', $dataprodi['id'])
            ->where('matkul', $request->matkul)
            ->where('sks', $request->sks)
            ->where('semester', $request->semester)
            ->exists()
        ) {
            return new MatkulResource(422, "Data telah tersedia!", [
                ["Prodi" => $dataprodi['prodi_full']],
                ["Matkul" => $request->matkul],
                ["SKS" => $request->sks],
                ["Semester" => $request->semester],
            ]);
        }

        //Kode Matkul
        $kodematkuls = Matkul::select('kode_matkul')->where('prodi', $dataprodi['id'])->latest()->first();
        if (isset($kodematkuls)) {
            $kodematkul = $kodematkuls['kode_matkul'];
        } else {
            //Kode Matkul => Kode Pordi + Semester + add 1 beforiet
            $kodematkul = $request->kodeprodi . $request->semester . '32';
        }

        $post = Matkul::create([
            'prodi' => $dataprodi['id'],
            'matkul' => $request->matkul,
            'kode_matkul' => $kodematkul + 1,
            'sks' => $request->sks,
            "semester" => $request->semester,
            'added_by' => $request->added_by
        ]);


        //return response
        return new MatkulResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }
}
