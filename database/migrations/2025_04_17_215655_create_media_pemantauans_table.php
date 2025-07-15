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
        Schema::create('media_pemantauan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemantauan_id');
            $table->unsignedBigInteger('media_id');

            $table->foreign('pemantauan_id')->references('id')->on('pemantauan')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('media')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_pemantauan');
    }
};
