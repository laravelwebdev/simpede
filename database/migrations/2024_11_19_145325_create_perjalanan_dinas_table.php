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
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_spd')->nullable();
            $table->date('tanggal_st')->nullable();
            $table->date('tanggal_berangkat')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->string('uraian')->nullable();
            $table->string('jenis', 40)->nullable();
            $table->mediumInteger('tujuan_master_wilayah_id')->nullable()->unsigned();
            $table->mediumInteger('spd_naskah_keluar_id')->nullable()->unsigned();
            $table->mediumInteger('st_naskah_keluar_id')->nullable()->unsigned();
            $table->mediumInteger('spd_kode_arsip_id')->nullable()->unsigned();
            $table->mediumInteger('st_kode_arsip_id')->nullable()->unsigned();
            $table->mediumInteger('ppk_user_id')->nullable()->unsigned();
            $table->mediumInteger('kepala_user_id')->nullable()->unsigned();
            $table->mediumInteger('mata_anggaran_id')->nullable()->unsigned();
            $table->mediumInteger('kerangka_acuan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
};
