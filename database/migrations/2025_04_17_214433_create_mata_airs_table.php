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
        Schema::create('mata_air', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mata_air');
            $table->string('short_desc');
            $table->text('long_desc');
            $table->text('alamat_mata_air');
            $table->string('lat');
            $table->string('lng');
            $table->string('kondisi');
            $table->string('status_mata_air');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_air');
    }
};
