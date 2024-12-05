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
        Schema::create('master_barang_pemeliharaans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 12)->nullable();
            $table->smallInteger('nup')->nullable()->unsigned();
            $table->string('nama_barang')->nullable();
            $table->string('merk')->nullable();
            $table->string('nopol', 16)->nullable();
            $table->string('kondisi', 20)->nullable();
            $table->string('lokasi', 100)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->mediumInteger('user_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_barang_pemeliharaans');
    }
};
