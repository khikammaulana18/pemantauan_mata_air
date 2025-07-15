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
        Schema::create('pemantauan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mata_air_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('tgl_pemantauan');
            $table->string('debit_mata_air');
            $table->string('kondisi_air');
            $table->text('kerusakan');
            $table->foreign('mata_air_id')->references('id')->on('mata_air')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->noActionOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemantauan');
    }
};
