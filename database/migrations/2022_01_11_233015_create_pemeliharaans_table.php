<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeliharaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeliharaans', function (Blueprint $table) {
            $table->id();
            $table->string('nopol')->rules('required');
            $table->string('nama')->rules('required');
            $table->string('jenis')->rules('required');
            $table->string('jenis_pemeliharaan')->rules('required');
            $table->date('tanggal')->rules('required');
            $table->unsignedMediumInteger('jumlah')->rules('required');
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
        Schema::dropIfExists('pemeliharaans');
    }
}
