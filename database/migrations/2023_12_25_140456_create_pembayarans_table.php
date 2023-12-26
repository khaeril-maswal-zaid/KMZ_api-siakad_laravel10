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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 50)->unique();
            $table->string('from_bank', 50)->unique();
            $table->unsignedBigInteger('mahasiswa');
            $table->unsignedBigInteger('prodi');
            $table->unsignedBigInteger('total_biaya');
            $table->integer('bayar');
            $table->integer('sisa_bayar');
            $table->boolean('lunas');
            $table->string('added_by', 200);
            $table->timestamps();

            $table->foreign('prodi')->references('id')->on('prodis');
            $table->foreign('mahasiswa')->references('id')->on('mahasiswas');
            $table->foreign('total_biaya')->references('id')->on('biaya_kuliahs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
