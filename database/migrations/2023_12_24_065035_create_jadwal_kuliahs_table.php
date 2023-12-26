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
        Schema::create('jadwal_kuliahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi');
            $table->unsignedBigInteger('matkul');
            $table->unsignedBigInteger('dosen');
            $table->integer('semester');
            $table->string('ruangan', 50);
            $table->string('hari', 10);
            $table->string('waktu', 10);
            $table->string('added_by', 200);
            $table->timestamps();

            $table->foreign('prodi')->references('id')->on('prodis');
            $table->foreign('matkul')->references('id')->on('matkuls');
            $table->foreign('dosen')->references('id')->on('dosens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kuliahs');
    }
};
