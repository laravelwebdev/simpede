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
        Schema::create('reward_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->date('tanggal_penetapan')->nullable();
            $table->mediumInteger('user_id')->nullable()->unsigned();
            $table->mediumInteger('kepala_user_id')->nullable()->unsigned();
            $table->mediumInteger('sk_naskah_keluar_id')->nullable()->unsigned();
            $table->mediumInteger('sertifikat_naskah_keluar_id')->nullable()->unsigned();
            $table->string('status', 20)->nullable();
            $table->string('arsip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_pegawais');
    }
};
