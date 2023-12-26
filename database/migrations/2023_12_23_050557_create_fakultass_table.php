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
        Schema::create('fakultass', function (Blueprint $table) {
            $table->id();
            $table->string('kode_fakultas', 10);
            $table->string('fakultas_full', 200);
            $table->string('fakultas', 75);
            $table->unsignedBigInteger('dekan');
            $table->string('added_by', 200);
            $table->timestamps();

            $table->foreign('dekan')->references('id')->on('dosens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakultass');
    }
};
