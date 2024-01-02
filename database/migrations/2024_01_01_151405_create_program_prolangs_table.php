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
        Schema::create('program_prolangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi');
            $table->string('tahun_akademik', 10);
            $table->unsignedBigInteger('matkul');
            $table->unsignedBigInteger('prolang');
            $table->boolean('lunas');
            $table->timestamps();

            $table->foreign('prodi')->references('id')->on('prodis');
            $table->foreign('matkul')->references('id')->on('rancangan_studis');
            $table->foreign('prolang')->references('id')->on('prolangs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_prolangs');
    }
};
