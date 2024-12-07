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
        Schema::create('realisasi_anggarans', function (Blueprint $table) {
            $table->id();
            $table->integer('nilai')->nullable();
            $table->mediumInteger('daftar_sp2d_id')->nullable()->unsigned();
            $table->mediumInteger('dipa_id')->nullable()->unsigned();
            $table->mediumInteger('mata_anggaran_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_anggarans');
    }
};
