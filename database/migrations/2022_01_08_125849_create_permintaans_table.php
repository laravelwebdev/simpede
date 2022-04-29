<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermintaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->integer('s1');
            $table->string('nomor');
            $table->date('tanggal');
            $table->string('rincian');
            $table->string('unit')->nullable();
            $table->string('program')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('kro')->nullable();
            $table->string('ro')->nullable();
            $table->string('komponen')->nullable();
            $table->string('sub')->nullable();
            $table->string('akun')->nullable();
            $table->unsignedSmallInteger('detail')->nullable();
            $table->string('volume')->nullable();
            $table->unsignedInteger('harga')->nullable();
            $table->unsignedInteger('jumlah')->nullable();
            $table->unsignedInteger('realisasi')->nullable();
            $table->unsignedInteger('sisa')->nullable();
            $table->unsignedInteger('perkiraan')->nullable();
            $table->unsignedInteger('sisanett')->nullable();
            $table->string('mak')->nullable();
            $table->string('item')->nullable();
            $table->text('tambahan_kak')->nullable();
            //pemohon
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('jabatan')->nullable();
            //pengadaan
            $table->string('jenis')->nullable();
            $table->unsignedInteger('hps')->nullable();
            $table->unsignedSmallInteger('penyedia')->nullable();
            $table->string('no_spk')->nullable();
            $table->date('tgl_spk')->nullable();
            $table->string('no_bast')->nullable();
            $table->date('tgl_bast')->nullable();

            $table->text('spesifikasi')->nullable();
            $table->string('survei')->nullable();
            $table->string('waktu')->nullable();
            $table->date('awal')->nullable();
            $table->date('akhir')->nullable();
            //pejabat
            $table->string('ppk')->nullable();
            $table->string('nipppk')->nullable();
            $table->string('kepala')->nullable();
            $table->string('nipkepala')->nullable();
            //monitoring
            $table->date('terimappk')->nullable();
            $table->unsignedInteger('jumlah_bayar')->nullable();
            $table->date('terimappspm')->nullable();
            $table->date('bayar')->nullable();
            $table->string('carabayar')->nullable();
            $table->string('no_spby')->nullable();
            $table->string('kelompok')->nullable();
            //kelengkapan
            $table->string('permintaan')->nullable();
            $table->string('kak')->nullable();
            $table->string('sk')->nullable();
            $table->string('st')->nullable();
            $table->string('spj')->nullable();
            $table->string('laporan')->nullable();
            $table->string('kontrak')->nullable();
            $table->string('kk_mitra')->nullable();
            $table->string('kk_organik')->nullable();
            $table->string('dpr')->nullable();
            $table->string('kuitansi_spd')->nullable();
            $table->string('undangan')->nullable();
            $table->string('daftar_hadir')->nullable();
            $table->string('notulen')->nullable();

            $table->string('spby')->nullable();
            $table->string('spp')->nullable();

            $table->string('kuitansi')->nullable();
            $table->string('ppn')->nullable();
            $table->string('pph')->nullable();

            $table->string('spm')->nullable();
            $table->string('sp2d')->nullable();

            $table->string('scan')->nullable();

            $table->string('link')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permintaans');
    }
}
