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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('nidn', 30);
            $table->string('email', 150)->unique();
            $table->string('nomor_hp', 20);
            $table->string('jk', 1);
            $table->string('tempat_lahir', 100);
            $table->string('tanggal_lahir', 15);
            $table->string('alamat', 150);
            $table->string('image', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
