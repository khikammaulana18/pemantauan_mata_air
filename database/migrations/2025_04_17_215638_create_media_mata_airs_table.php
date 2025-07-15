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
        Schema::create('media_mata_air', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mata_air_id');
            $table->unsignedBigInteger('media_id');

            $table->foreign('mata_air_id')->references('id')->on('mata_air')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_mata_air');
    }
};
