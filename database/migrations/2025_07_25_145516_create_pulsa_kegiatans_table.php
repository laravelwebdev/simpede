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
        Schema::create('pulsa_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->string('token', 32)->nullable();
            $table->string('link')->nullable();
            $table->mediumInteger('unit_kerja_id')->nullable()->unsigned();
            $table->mediumInteger('mata_anggaran_id')->nullable()->unsigned();
            $table->mediumInteger('koordinator_user_id')->nullable()->unsigned();
            $table->mediumInteger('ppk_user_id')->nullable()->unsigned();
            $table->mediumInteger('jenis_pulsa_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pulsa_kegiatans');
    }
};
