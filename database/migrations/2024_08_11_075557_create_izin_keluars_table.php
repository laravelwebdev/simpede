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
        Schema::create('izin_keluars', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->time('keluar', precision: 0)->nullable();
            $table->time('kembali', precision: 0)->nullable();
            $table->text('kegiatan')->nullable();
            $table->string('bukti')->nullable();
            $table->mediumInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin_keluars');
    }
};
