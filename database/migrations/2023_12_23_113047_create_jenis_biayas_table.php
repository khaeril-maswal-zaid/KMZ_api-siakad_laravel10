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
        Schema::create('jenis_biayas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_biaya', 50)->unique();
            $table->integer('kode_jenis')->unique();
            $table->string('added_by', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_biayas');
    }
};
