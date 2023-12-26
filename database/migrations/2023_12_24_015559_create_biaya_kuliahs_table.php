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
            $table->string('kode_bayar', 50)->unique();
            $table->string('added_by', 200);
            $table->timestamps();

            $table->foreign('prodi')->references('id')->on('prodis');
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
