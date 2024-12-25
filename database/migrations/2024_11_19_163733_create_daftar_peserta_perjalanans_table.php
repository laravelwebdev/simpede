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
        Schema::create('daftar_peserta_perjalanans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kuitansi')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->string('angkutan', 20)->nullable();
            $table->string('asal', 80)->nullable();
            $table->mediumInteger('ppk_user_id')->nullable()->unsigned();
            $table->mediumInteger('perjalanan_dinas_id')->nullable()->unsigned();
            $table->mediumInteger('user_id')->nullable()->unsigned();
            $table->mediumInteger('bendahara_user_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_peserta_perjalanans');
    }
};
