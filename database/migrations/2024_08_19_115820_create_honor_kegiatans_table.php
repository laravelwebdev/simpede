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
            $table->date('tanggal_kak')->nullable();
            $table->string('judul_spj')->nullable();
            $table->string('mak', 40)->nullable();
            $table->integer('perkiraan_anggaran')->unsigned()->nullable();
            $table->date('awal')->nullable();
            $table->date('akhir')->nullable();
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
            $table->string('kegiatan')->nullable();
            $table->string('status', 20)->nullable();
            $table->mediumInteger('kamus_anggaran_id')->unsigned()->nullable();
            $table->mediumInteger('kerangka_acuan_id')->unsigned()->nullable();
            $table->mediumInteger('anggaran_kerangka_acuan_id')->unsigned()->nullable();
            $table->mediumInteger('koordinator_user_id')->nullable()->unsigned();
            $table->mediumInteger('ppk_user_id')->nullable()->unsigned();
            $table->mediumInteger('kepala_user_id')->nullable()->unsigned();
            $table->mediumInteger('kpa_user_id')->nullable()->unsigned();
            $table->mediumInteger('bendahara_user_id')->nullable()->unsigned();
            $table->mediumInteger('unit_kerja_id')->nullable()->unsigned();
            $table->mediumInteger('sk_kode_arsip_id')->nullable()->unsigned();
            $table->mediumInteger('st_kode_arsip_id')->nullable()->unsigned();
            $table->mediumInteger('sk_naskah_keluar_id')->nullable()->unsigned();
            $table->mediumInteger('st_naskah_keluar_id')->nullable()->unsigned();
            $table->mediumInteger('kepka_mitra_id')->nullable()->unsigned();
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
