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
        Schema::create('distriks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_distrik')->nullable();
            $table->string('kode_distrik')->nullable();
            $table->string('keterangan')->nullable();
            $table->json('geojson')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distriks');
    }
};
