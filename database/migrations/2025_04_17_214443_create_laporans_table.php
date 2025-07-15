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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mata_air_id');
            $table->string('kode_laporan')->nullable();
            $table->timestamp('tgl_pelaporan')->useCurrent();
            $table->string('nama');
            $table->string('job');
            $table->text('desc_laporan');
            $table->string('status_laporan');
            $table->foreign('mata_air_id')->references('id')->on('mata_air')->noActionOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
