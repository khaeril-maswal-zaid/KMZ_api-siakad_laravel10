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
            'from_bank' => 'required|unique:pembayarans',
            'nimmahasiswa' => 'required|numeric',
            'namamahasiswa' => 'required',
            'kodeprodi' => 'required|numeric',
            'kodebayar' => 'required|numeric',
            'bayar' => 'required|numeric|min:100000',
            'kodeoleh' => 'required|numeric|digits_between:3,3',
            'added_by' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            // return response()->json($validator->errors(), 422);
            return new PembayaranResource(422, $validator->errors(), null);
        }


        //Cek ketersediaan data
        //----------------------------------------------------------------------------------------
        $datamahasiswa = Mahasiswa::select('id', 'nama', 'prodi')->where('nim', $request->nimmahasiswa)->first();
        $dataprodi = Prodi::select('id', 'prodi_full')->where('kode_prodi', $request->kodeprodi)->first();
        $datapembayaran = Biaya_kuliah::select('id', 'jumlah', 'prodi')->where('kode_bayar', $request->kodebayar)->first();

        if (!isset($datamahasiswa)) {
            return new PembayaranResource(404, "Mahasiswa tidak ditemukan!", null);
        }

        if (!isset($dataprodi)) {
            return new PembayaranResource(404, "Prodi tidak ditemukan!", null);
        }

        if (!isset($datapembayaran)) {
            return new PembayaranResource(404, "Kode bayar tidak ditemukan!", null);
        }
        //-----------------------------------------------------------------------------------------



        //TERIMA DATA NIM DAN NAMA MAHASISWA
        //QUERY NIM KEMUDIAN HASILNYA SEIMBANGKAN DENGAN NAMA YANG DITERIMA
        if ($datamahasiswa['nama'] != $request->namamahasiswa) {
            return new PembayaranResource(422, "'nama' Error!", null);
        };

        $prodibymahasiswa = Prodi::select('prodi_full')->findOrFail($datamahasiswa['prodi']);
        $prodibypembayaran = Prodi::select('prodi_full')->findOrFail($datapembayaran['prodi']);

        //CEK PRODI HASRUS SAMA PRODI GET DENGAN PRODI MAHASISWA
        if ($datamahasiswa['prodi'] != $dataprodi['id'] || $prodibypembayaran['prodi_full'] != $prodibymahasiswa['prodi_full']) {
            return new PembayaranResource(422, "Prodi tidak singkron", [
                "Prodi get: " . $dataprodi['prodi_full'],
                "Prodi mahasiswa: " . $prodibymahasiswa['prodi_full'],
                "Prodi biaya: " . $prodibypembayaran['prodi_full'],
            ]);
        }

        //KODE TRANSAKSI
        //date=>dmy + kode oleh + nim + random=> 3 digit
        $kodetransaksi = date('dmy') .  $request->nimmahasiswa . $request->kodeoleh . random_int(111, 999);

        if (Pembayaran::where('kode_transaksi', $kodetransaksi)->exists()) {
            return new PembayaranResource(422, "Ulangi!, Terdapat kesalahan", null);
        }

        //Sisa bayar
        $sisabayar = $datapembayaran['jumlah'] - $request->bayar;

        //UNTUK PEMBAYARN LEBIH DARI 1 KALI
        $sisabayarlama = (Pembayaran::select('sisa_bayar')->where('total_biaya', $datapembayaran['id'])->where('mahasiswa', $datamahasiswa['id'])->latest()->value('sisa_bayar'));

        if (isset($sisabayarlama) && $sisabayarlama > 0) {
            //Cek jumlah bayar dengan inputan bayar
            if ($request->bayar > $sisabayarlama) {
                return new PembayaranResource(422, "Jumlah bayar melebihi harga semestinya", [
                    'Jumlah semestinya:' => $sisabayarlama,
                    'Yang anda bayar:' => $request->bayar
                ]);
            }

            $sisabayar = $sisabayarlama - $request->bayar;
            Pembayaran::where('total_biaya', $datapembayaran['id'])->where('mahasiswa', $datamahasiswa['id'])->latest()->first()->update(['lunas' => true]);
        } elseif (isset($sisabayarlama) && $sisabayarlama == 0) {
            return new PembayaranResource(422, "Pembayaran sebelumnya telah lunas",  $sisabayarlama);
        }
        //--------------------------------

        //Cek jumlah bayar dengan inputan bayar
        if ($request->bayar > $datapembayaran['jumlah']) {
            return new PembayaranResource(422, "Jumlah bayar melebihi harga semestinya", [
                'Jumlah semestinya:' => $datapembayaran['jumlah'],
                'Yang anda bayar:' => $request->bayar
            ]);
        }

        if ($sisabayar == 0) {
            $lunas = true;
        } else {
            $lunas = false;
        }

        $post = Pembayaran::create([
            'kode_transaksi' => $kodetransaksi,
            'from_bank' => $request->from_bank,
            'mahasiswa' => $datamahasiswa['id'],
            'prodi' => $dataprodi['id'],
            'total_biaya' => $datapembayaran['id'],
            'bayar' => $request->bayar,
            'sisa_bayar' => $sisabayar,
            'lunas' => $lunas,
            'added_by' => $request->added_by
        ]);


        //return response
        return new PembayaranResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }
}
