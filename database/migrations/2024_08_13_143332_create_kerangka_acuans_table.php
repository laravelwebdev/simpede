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
        Schema::create('kerangka_acuans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->integer('no_urut')->nullable();
            $table->string('nomor')->unique()->nullable();
            $table->string('rincian')->nullable();
            $table->text('latar')->nullable();
            $table->text('maksud')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('sasaran')->nullable();
            $table->string('tkdn', 5)->nullable();
            $table->string('jenis', 30)->nullable();
            $table->string('metode', 30)->nullable();
            $table->text('anggaran')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->text('kegiatan')->nullable();
            $table->date('awal')->nullable();
            $table->date('akhir')->nullable();
            $table->string('nama')->nullable();
            $table->string('nip',30)->nullable();
            $table->string('jabatan',50)->nullable();
            $table->bigInteger('unit_kerja_id')->nullable()->unsigned();
            $table->string('ppk')->nullable();
            $table->string('nipppk',30)->nullable();
            $table->string('link')->nullable();
            $table->string('tahun', 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerangka_acuans');
    }
};
