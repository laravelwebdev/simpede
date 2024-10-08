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
        Schema::create('honor_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('judul_spj')->nullable();
            $table->string('satuan', 20)->nullable();
            $table->date('tanggal_spj')->nullable();
            $table->boolean('generate_sk')->nullable();
            $table->boolean('generate_st')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->date('tanggal_st')->nullable();
            $table->string('objek_sk')->nullable();
            $table->string('uraian_tugas')->nullable();
            $table->string('jenis_honor', 40)->nullable();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('jenis_kontrak', 40)->nullable();
            $table->string('status', 30)->nullable();
            $table->bigInteger('kamus_anggaran_id')->unsigned()->nullable();
            $table->bigInteger('anggaran_kerangka_acuan_id')->unsigned()->nullable();
            $table->bigInteger('koordinator_user_id')->nullable()->unsigned();
            $table->bigInteger('ppk_user_id')->nullable()->unsigned();
            $table->bigInteger('bendahara_user_id')->nullable()->unsigned();
            $table->bigInteger('unit_kerja_id')->nullable()->unsigned();
            $table->bigInteger('kode_arsip_id')->nullable()->unsigned();
            $table->bigInteger('sk_naskah_keluar_id')->nullable()->unsigned();
            $table->bigInteger('st_naskah_keluar_id')->nullable()->unsigned();
            $table->bigInteger('kepka_mitra_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honor_kegiatans');
    }
};
