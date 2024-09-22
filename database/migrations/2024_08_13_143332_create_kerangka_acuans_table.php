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
            $table->text('rincian')->nullable();
            $table->text('latar')->nullable();
            $table->text('maksud')->nullable();
            $table->text('tujuan')->nullable();
            $table->text('sasaran')->nullable();
            $table->string('tkdn', 5)->nullable();
            $table->string('jenis', 30)->nullable();
            $table->string('metode', 30)->nullable();
            $table->text('kegiatan')->nullable();
            $table->date('awal')->nullable();
            $table->date('akhir')->nullable();
            $table->string('status', 30)->nullable();
            $table->bigInteger('naskah_keluar_id')->unsigned()->nullable();
            $table->bigInteger('dipa_id')->nullable()->unsigned();
            $table->bigInteger('unit_kerja_id')->nullable()->unsigned();
            $table->bigInteger('ppk_user_id')->nullable()->unsigned();
            $table->bigInteger('koordinator_user_id')->nullable()->unsigned();
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
