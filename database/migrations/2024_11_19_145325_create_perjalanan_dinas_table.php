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
        Schema::create('perjalanan_dinas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_spd')->nullable();
            $table->date('tanggal_st')->nullable();
            $table->string('uraian')->nullable();
            $table->mediumInteger('spd_naskah_keluar_id')->nullable();
            $table->mediumInteger('st_naskah_keluar_id')->nullable();
            $table->mediumInteger('anggaran_kerangka_acuan_id')->nullable();
            $table->mediumInteger('kerangka_acuan_id')->nullable();
            $table->timestamps();
 


            $table->id();
            $table->text('spesifikasi')->nullable();
            $table->string('angkutan',20)->nullable();
            $table->date('tanggal_berangkat')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->string('asal', 80)->nullable();
            $table->string('tujuan', 80)->nullable();
            $table->mediumInteger('ppk_user_id')->nullable();
            $table->mediumInteger('perjalanan_id')->nullable();
            $table->mediumInteger('user_id')->nullable();
            $table->mediumInteger('bendahara_user_id')->nullable();
            $table->timestamps();
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjalanan_dinas');
    }
};