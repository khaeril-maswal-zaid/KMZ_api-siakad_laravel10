<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('nim', 30)->unique();
            $table->unsignedBigInteger('prodi');
            $table->unsignedBigInteger('fakultas');
            $table->string('nik', 16)->unique();
            $table->string('email', 150)->unique();
            $table->string('nomor_hp', 20);
            $table->string('jk', 1);
            $table->string('tempat_lahir', 100);
            $table->string('tanggal_lahir', 15);
            $table->string('agama', 15);
            $table->string('provinsi', 100);
            $table->string('kabupaten', 100);
            $table->string('kecamatan', 100);
            $table->string('desa', 100);
            $table->string('alamat', 150);
            $table->string('nama_ayah', 255);
            $table->string('nomor_hp_ayah', 20);
            $table->string('pekerjaan_ayah', 100);
            $table->string('penghasilan_ayah', 100);
            $table->string('nama_ibu', 255);
            $table->string('nomor_hp_ibu', 20);
            $table->string('pekerjaan_ibu', 100);
            $table->string('penghasilan_ibu', 100);
            $table->string('jumlah_bersaudara', 11);
            $table->string('anak_ke', 11);
            $table->string('asal_sekolah', 255);
            $table->string('nisn', 10)->unique();
            $table->string('tahun_lulus', 4);
            $table->string('jurusan_sekolah', 100);
            $table->string('foto', 255)->unique();
            $table->string('angkatan', 4);
            $table->unsignedBigInteger('pull_by');
            $table->timestamps();

            $table->foreign('prodi')->references('id')->on('prodis');
            $table->foreign('fakultas')->references('id')->on('fakultass');
            $table->foreign('pull_by')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
