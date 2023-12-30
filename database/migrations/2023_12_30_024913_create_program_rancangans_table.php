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
        Schema::create('program_rancangans', function (Blueprint $table) {
            $table->id();
            $table->string('angkatan', 4);
            $table->string('kode_program', 11)->unique();
            $table->unsignedBigInteger('prodi');
            $table->unsignedBigInteger('matkul');
            $table->string('added_by', 200);
            $table->timestamps();

            $table->foreign('prodi')->references('id')->on('prodis');
            $table->foreign('matkul')->references('id')->on('matkuls');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_rancangans');
    }
};
