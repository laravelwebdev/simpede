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
        Schema::create('naskah_keluars', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->integer('no_urut')->nullable()->unsigned();
            $table->integer('segmen')->nullable()->unsigned();
            $table->string('nomor')->nullable();
            $table->string('derajat', 10)->nullable();
            $table->string('tujuan')->nullable();
            $table->text('perihal')->nullable();
            $table->string('pengiriman')->nullable();
            $table->date('tanggal_kirim')->nullable();
            $table->string('draft')->nullable();
            $table->string('signed')->nullable();
            $table->char('generate', 1)->default('M');
            $table->mediumInteger('jenis_naskah_id')->nullable()->unsigned();
            $table->mediumInteger('kode_arsip_id')->nullable()->unsigned();
            $table->mediumInteger('kode_naskah_id')->nullable()->unsigned();
            $table->mediumInteger('unit_kerja_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naskah_keluars');
    }
};
