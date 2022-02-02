<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poks', function (Blueprint $table) {
            $table->id();
            $table->string('program');
            $table->string('kegiatan');
            $table->string('kro');
            $table->string('ro');
            $table->string('komponen');
            $table->string('sub');
            $table->string('akun');
            $table->string('detail');
            $table->string('volume');
            $table->unsignedBigInteger('harga');
            $table->unsignedBigInteger('jumlah');
            $table->string('mak');
            $table->date('revisi');
            $table->unsignedBigInteger('realisasi');
            $table->unsignedBigInteger('sisa');
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
        Schema::dropIfExists('poks');
    }
}
