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
        Schema::create('kontrak_mitras', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_honor', 40)->nullable();
            $table->string('nama_kontrak')->nullable();
            $table->date('awal_kontrak')->nullable();
            $table->date('akhir_kontrak')->nullable();
            $table->date('tanggal_spk')->nullable();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('file')->nullable();
            $table->string('status', 20)->nullable();
            $table->mediumInteger('jenis_kontrak_id')->nullable()->unsigned();
            $table->mediumInteger('ppk_user_id')->nullable()->unsigned();
            $table->mediumInteger('kode_arsip_id')->nullable()->unsigned();
            $table->mediumInteger('honor_kegiatan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_mitras');
    }
};
