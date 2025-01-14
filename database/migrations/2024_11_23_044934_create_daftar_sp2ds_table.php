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
        Schema::create('daftar_sp2ds', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_sp2d')->nullable();
            $table->string('nomor_spp', 10)->nullable();
            $table->string('nomor_sp2d', 20)->nullable();
            $table->text('uraian', 20)->nullable();
            $table->string('arsip_spm')->nullable();
            $table->string('arsip_lampiran')->nullable();
            $table->string('arsip_spp')->nullable();
            $table->string('arsip_sp2d')->nullable();
            $table->mediumInteger('dipa_id')->nullable()->unsigned();
            $table->fullText('uraian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_sp2ds');
    }
};
