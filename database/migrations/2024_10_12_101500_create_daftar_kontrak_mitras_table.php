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
        Schema::create('daftar_kontrak_mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kontrak', 40)->nullable();
            $table->string('nomor_bast', 40)->nullable();
            $table->smallInteger('jumlah_kegiatan')->unsigned()->nullable();
            $table->mediumInteger('nilai_kontrak')->unsigned()->nullable();
            $table->mediumInteger('mitra_id')->unsigned()->nullable();
            $table->mediumInteger('kontrak_mitra_id')->unsigned()->nullable();
            $table->mediumInteger('bast_mitra_id')->unsigned()->nullable();
            $table->mediumInteger('honor_id')->unsigned()->nullable();
            $table->string('status', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_kontrak_mitras');
    }
};
