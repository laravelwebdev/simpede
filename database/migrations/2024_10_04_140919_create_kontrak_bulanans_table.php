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
        Schema::create('kontrak_bulanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kontrak')->nullable();
            $table->date('awal_kontrak')->nullable();
            $table->date('akhir_kontrak')->nullable();
            $table->date('tanggal_spk')->nullable();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('jenis_kontrak', 40)->nullable();
            $table->string('status', 30)->nullable();
            $table->bigInteger('ppk_user_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_bulanans');
    }
};