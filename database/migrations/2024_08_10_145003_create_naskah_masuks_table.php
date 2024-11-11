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
        Schema::create('naskah_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor')->unique()->nullable();
            $table->date('tanggal')->nullable();
            $table->string('pengirim', 10)->nullable();
            $table->text('perihal')->nullable();
            $table->string('arsip')->nullable();
            $table->mediumInteger('jenis_naskah_id')->nullable()->unsigned();
            $table->fullText('perihal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naskah_masuks');
    }
};
