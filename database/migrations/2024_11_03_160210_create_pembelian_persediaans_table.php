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
        Schema::create('pembelian_persediaans', function (Blueprint $table) {
            $table->id();
            $table->string('rincian')->nullable();
            $table->date('tanggal_kak')->nullable();
            $table->date('tanggal_bast')->nullable();
            $table->date('tanggal_buku')->nullable();
            $table->string('status', 20)->nullable();
            $table->mediumInteger('anggaran_kerangka_acuan_id')->unsigned()->nullable();
            $table->mediumInteger('kerangka_acuan_id')->unsigned()->nullable();
            $table->mediumInteger('bast_naskah_keluar_id')->unsigned()->nullable();
            $table->mediumInteger('ppk_user_id')->unsigned()->nullable();
            $table->mediumInteger('pbmn_user_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_persediaans');
    }
};
