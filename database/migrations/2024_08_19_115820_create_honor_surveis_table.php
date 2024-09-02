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
            $table->bigInteger('nomor_sk')->unsigned()->nullable();
            $table->bigInteger('nomor_st')->unsigned()->nullable();
            $table->string('judul_spj')->nullable();
            $table->string('mak', 40)->nullable();
            $table->string('detail')->nullable();
            $table->date('awal')->nullable();
            $table->date('akhir')->nullable();
            $table->string('satuan', 20)->nullable();
            $table->date('tanggal_spj')->nullable();
            $table->bigInteger('unit_kerja_id')->nullable();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('jenis', 20)->nullable();
            $table->string('kegiatan')->nullable();
            $table->text('pegawai')->nullable();
            $table->string('ketua', 80)->nullable();
            $table->string('nipketua', 40)->nullable();
            $table->string('ppk', 80)->nullable();
            $table->string('nipppk', 40)->nullable();
            $table->string('bendahara', 80)->nullable();
            $table->string('nipbendahara', 40)->nullable();
            $table->string('link_spj')->nullable();
            $table->string('link_st')->nullable();
            $table->string('link_sk')->nullable();            
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
