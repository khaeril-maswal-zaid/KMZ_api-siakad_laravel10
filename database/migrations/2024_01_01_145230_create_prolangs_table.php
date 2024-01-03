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
        Schema::create('prolangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_prolang')->unique();
            $table->string('prolang');
            $table->integer('harga');
            $table->string('satuan');
            $table->text('Deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prolangs');
    }
};
