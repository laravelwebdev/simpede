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
        Schema::create('digital_payments', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_transaksi')->nullable();
            $table->string('jenis', 3)->nullable();
            $table->mediumInteger('jumlah')->nullable()->unsigned();
            $table->date('tanggal_pembayaran')->nullable();
            $table->string('nomor', 50)->nullable();
            $table->mediumInteger('kerangka_acuan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_payments');
    }
};
