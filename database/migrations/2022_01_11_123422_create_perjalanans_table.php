<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjalanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjalanans', function (Blueprint $table) {
            $table->id();
            $table->integer('s1');
            $table->string('nomor');
            $table->date('tanggal');
            $table->string('no_st')->nullable();
            $table->string('tujuan_spd')->nullable();
            $table->unsignedTinyInteger('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('golongan')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('waktu')->nullable();
            $table->date('berangkat')->nullable();
            $table->date('kembali')->nullable();
            $table->string('asal')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('tempat_tujuan')->nullable();
            $table->string('angkutan')->nullable();
            $table->string('mak')->nullable();
            $table->text('biaya')->nullable();
            //pejabat
            $table->string('ppk')->nullable();
            $table->string('nipppk')->nullable();
            $table->string('kepala')->nullable();
            $table->string('nipkepala')->nullable();
            $table->string('bendahara')->nullable();
            $table->string('nipbendahara')->nullable();

            //identifier permintaan
            $table->string('no_permintaan')->unique()->nullable();
            $table->string('tgl_permintaan')->nullable();

            $table->string('link')->nullable();
            $table->string('link_dpr')->nullable();
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
        Schema::dropIfExists('perjalanans');
    }
}
