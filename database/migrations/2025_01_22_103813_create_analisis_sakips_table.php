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
        Schema::create('analisis_sakips', function (Blueprint $table) {
            $table->id();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('kategori', 50)->nullable();
            $table->string('kegiatan')->nullable();
            $table->text('kendala')->nullable();
            $table->text('solusi')->nullable();
            $table->text('bukti_solusi')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->string('bulan_deadline', 2)->nullable();
            $table->text('bukti_tl')->nullable();
            $table->mediumInteger('penanggung_jawab')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.kategori
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_sakips');
    }
};
