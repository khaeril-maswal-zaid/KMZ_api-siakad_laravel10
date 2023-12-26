<?php

namespace App\Http\Controllers;

use App\Http\Resources\PembayaranResource;
use App\Models\Biaya_kuliah;
use App\Models\Mahasiswa;
use App\Models\Pembayaran;
use App\Models\Prodi;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_bank' => 'required',
            'nimmahasiswa' => 'required|numeric',
            'namamahasiswa' => 'required',
            'kodeprodi' => 'required|numeric',
            'total_biaya' => 'required|numeric',
            'bayar' => 'required|numeric|min:100000',
            'kodeoleh' => 'required|numeric|digits_between:3,3',
            'added_by' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new PembayaranResource(422, $validator->errors(), null);
        }


        //----------------------------------------------------------------------------------------
        $datamahasiswa = Mahasiswa::select('id', 'nama')->where('nim', $request->nimmahasiswa)->first();
        $id_prodi = Prodi::select('id')->where('kode_prodi', $request->kodeprodi)->get()->value('id');
        $datapembayaran = Biaya_kuliah::select('id', 'jumlah')->where('kode_bayar', $request->kodebayar)->first();

        if (!isset($datamahasiswa)) {
            return new PembayaranResource(404, "'id_mahasiswa' Not Found!", null);
        }
        $mahasiswa = $datamahasiswa->toArray();

        if (!isset($id_prodi)) {
            return new PembayaranResource(404, "'id_prodi' Not Found!", null);
        }

        if (!isset($datapembayaran)) {
            return new PembayaranResource(404, "'id_bayar' Not Found!", null);
        }
        $pembayaran = $datapembayaran->toArray();
        //-----------------------------------------------------------------------------------------



        //TERIMA DATA NIM DAN NAMA MAHASISWA
        //QUERY NIM KEMUDIAN HASILNYA SEIMBANGKAN DENGAN NAMA YANG DITERIMA
        if ($mahasiswa['nama'] != $request->namamahasiswa) {
            return new PembayaranResource(422, "'nama' Error!", null);
        };

        //KODE TRANSAKSI
        //date=>dmy + kode oleh + nim + random=> 3 digit
        $kodetransaksi = date('dmy') . $request->kodeoleh . $request->nimmahasiswa . random_int(111, 999);

        if (Pembayaran::where('kode_transaksi', $kodetransaksi)->exists()) {
            return new PembayaranResource(422, "Data kode transaksi telah exsist", $kodetransaksi);
        }

        $sisabayar = $pembayaran['jumlah'] - $request->bayar;

        if ($sisabayar == 0) {
            $lunas = true;
        } else {
            $lunas = false;
        }

        $post = Pembayaran::create([
            'kode_transaksi' => $kodetransaksi,
            'from_bank' => $request->from_bank,
            'mahasiswa' => $mahasiswa['id'],
            'prodi' => $id_prodi,
            'total_biaya' => $pembayaran['id'],
            'bayar' => $request->bayar,
            'sisa_bayar' => $sisabayar,
            'lunas' => $lunas,
            'added_by' => $request->added_by
        ]);


        //return response
        return new PembayaranResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }
}
