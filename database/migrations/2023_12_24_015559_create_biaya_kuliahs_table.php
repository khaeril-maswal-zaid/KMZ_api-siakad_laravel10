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
        Schema::create('biaya_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi');
            $table->string('tahun_akademik', 10);
            $table->integer('semester');
            $table->integer('jumlah');
            $table->unsignedBigInteger('jenis_biaya');
            $table->string('kode_biaya', 11);
            $table->string('added_by', 200);
            $table->timestamps();

            $table->foreign('prodi')->references('id')->on('prodis');
            $table->foreign('jenis_biaya')->references('id')->on('jenis_biayas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya_kuliahs');
    }
};
