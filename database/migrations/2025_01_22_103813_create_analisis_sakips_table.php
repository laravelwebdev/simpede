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
            $table->string('kegiatan')->nullable();
            $table->text('kendala')->nullable();
            $table->text('solusi')->nullable();
            $table->text('bukti_solusi')->nullable();
            $table->text('indikator')->nullable();
            $table->mediumInteger('unit_kerja_id')->nullable()->unsigned();
            $table->fullText('kendala')->nullable();
            $table->fullText('solusi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.kategori.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_sakips');
    }
};
