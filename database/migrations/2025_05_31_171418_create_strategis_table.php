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
        Schema::create('strategis', function (Blueprint $table) {
            $table->id();
            $table->string('tipe')->nullable();
            $table->string('strategi_satu')->nullable();
            $table->string('strategi_dua')->nullable();
            $table->string('strategi_tiga')->nullable();
            $table->string('strategi_empat')->nullable();
            // $table->bigInteger('jenis_kriteria_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategis');
    }
};
