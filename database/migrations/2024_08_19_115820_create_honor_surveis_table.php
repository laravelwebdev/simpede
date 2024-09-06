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
        Schema::create('honor_surveis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kerangka_acuan_id')->unsigned()->nullable();
            $table->date('tanggal_kak')->nullable();
            $table->bigInteger('nomor_sk')->unsigned()->nullable();
            $table->bigInteger('nomor_st')->unsigned()->nullable();
            $table->string('judul_spj')->nullable();
            $table->string('mak', 40)->nullable();
            $table->string('detail')->nullable();
            $table->date('awal')->nullable();
            $table->date('akhir')->nullable();
            $table->string('satuan', 20)->nullable();
            $table->date('tanggal_spj')->nullable();
            $table->string('generate_sk', 5)->nullable();
            $table->string('generate_st', 5)->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->date('tanggal_st')->nullable();
            $table->string('objek_sk')->nullable();
            $table->string('uraian_tugas')->nullable();
            $table->bigInteger('unit_kerja_id')->nullable()->unsigned();
            $table->bigInteger('kode_arsip_id')->nullable()->unsigned();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('jenis_kontrak', 40)->nullable();
            $table->string('kegiatan')->nullable();
            $table->text('pegawai')->nullable();
            $table->string('ketua', 80)->nullable();
            $table->string('nipketua', 40)->nullable();
            $table->string('ppk', 80)->nullable();
            $table->string('nipppk', 40)->nullable();
            $table->string('bendahara', 80)->nullable();
            $table->string('nipbendahara', 40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honor_surveis');
    }
};
