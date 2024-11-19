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
        Schema::create('daftar_pemeliharaans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('uraian')->nullable();
            $table->string('penyedia', 100)->nullable();
            $table->mediumInteger('biaya')->nullable()->unsigned();
            $table->mediumInteger('pemeliharaan_id')->nullable()->unsigned();
            $table->mediumInteger('master_barang_pemeliharaan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_pemeliharaans');
    }
};
