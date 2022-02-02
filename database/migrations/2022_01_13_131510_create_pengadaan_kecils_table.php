<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanKecilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_kecils', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable();
            $table->string('rincian');
            $table->date('tgl_proses')->nullable();
            $table->string('nomor')->unique();
            $table->date('tanggal');
            $table->string('jenis')->nullable();
            $table->unsignedInteger('perkiraan');
            $table->text('spesifikasi')->nullable();
            $table->date('tgl_sp')->nullable();
            $table->unsignedSmallInteger('penyedia')->nullable();
            $table->string('alamat')->nullable();
            $table->unsignedInteger('jumlah_bayar');
            $table->string('mak');
            $table->string('program');
            $table->string('kegiatan');
            $table->string('kro');
            $table->string('ro');
            $table->string('komponen');
            $table->string('sub');
            $table->string('akun');
            $table->unsignedSmallInteger('detail')->nullable();
            $table->string('waktu');
            $table->date('awal');
            $table->date('akhir');

            //pejabat
            $table->string('ppk')->nullable();
            $table->string('nipppk')->nullable();
            $table->string('pbj')->nullable();
            $table->string('nippbj')->nullable();

            $table->string('link')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan_kecils');
    }
}
