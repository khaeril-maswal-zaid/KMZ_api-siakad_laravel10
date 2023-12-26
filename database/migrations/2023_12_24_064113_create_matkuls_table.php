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
        Schema::create('matkuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi');
            $table->string('matkul', 100);
            $table->integer('sks');
            $table->integer('semester');
            $table->string('kode_matkul', 50);
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
        Schema::dropIfExists('matkuls');
    }
};
