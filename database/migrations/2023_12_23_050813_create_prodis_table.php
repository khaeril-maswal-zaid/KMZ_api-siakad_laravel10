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
        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_fakultas');
            $table->string('kode_prodi', 10)->unique();
            $table->string('prodi_full', 200);
            $table->string('prodi', 75);
            $table->unsignedBigInteger('kaprodi');
            $table->string('added_by', 200);
            $table->timestamps();

            $table->foreign('id_fakultas')->references('id')->on('fakultass');
            $table->foreign('kaprodi')->references('id')->on('dosens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodis');
    }
};
