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
        Schema::create('arsip_keuangans', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor')->unsigned()->nullable();            
            $table->string('kode_klasifikasi')->nullable();
            $table->string('kode_unit_cipta')->nullable();
            $table->text('uraian')->nullable();
            $table->string('kurun_awal', 4)->nullable();
            $table->string('kurun_akhir', 4)->nullable();
            $table->string('tingkat_perkembangan')->nullable();
            $table->string('media_simpan')->nullable();
            $table->string('kondisi')->nullable();
            $table->tinyInteger('jumlah')->nullable();
            $table->string('kode_ruang')->nullable();
            $table->string('nomor_lemari')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip_keuangans');
    }
};
