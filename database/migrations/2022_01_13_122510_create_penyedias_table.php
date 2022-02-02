<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyedias', function (Blueprint $table) {
            $table->id();
            $table->string('penyedia');
            $table->string('nama_usaha');
            $table->string('alamat');
            $table->string('npwp')->nullable();
            $table->string('rekening')->nullable();
            $table->string('bank')->nullable();
            $table->string('penandatangan')->nullable();
            $table->string('surat_kuasa')->nullable();
            $table->string('kota')->nullable();
            $table->integer('nik')->nullable();
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
        Schema::dropIfExists('penyedias');
    }
}
