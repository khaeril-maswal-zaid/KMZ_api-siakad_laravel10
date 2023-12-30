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
        Schema::create('rancangan_studis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi');
            $table->unsignedBigInteger('mahasiswa');
            $table->integer('semester');
            $table->unsignedBigInteger('matkul');
            $table->boolean('programulang');
            $table->timestamps();

            $table->foreign('prodi')->references('id')->on('prodis');
            $table->foreign('mahasiswa')->references('id')->on('mahasiswas');
            $table->foreign('matkul')->references('id')->on('program_rancangans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rancangan_studis');
    }
};
