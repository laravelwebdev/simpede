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
        Schema::create('barang_persediaans', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('stok')->nullable();
            $table->date('tanggal_transaksi')->nullable();
            $table->mediumInteger('master_persediaan_id')->nullable()->nullable();
            $table->integer('barang_persediaanable_id')->nullable();
            $table->string('barang_persediaanable_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_persediaans');
    }
};
