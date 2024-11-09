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
        Schema::create('persediaan_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_dokumen', 40)->nullable();
            $table->date('tanggal_dokumen')->nullable();
            $table->string('rincian')->nullable();
            $table->date('tanggal_buku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan_masuks');
    }
};
