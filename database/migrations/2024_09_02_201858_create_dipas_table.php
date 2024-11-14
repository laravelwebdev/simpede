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
        Schema::create('dipas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 40)->nullable();
            $table->date('tanggal')->nullable();
            $table->tinyInteger('revisi')->nullable()->unsigned();
            $table->date('tanggal_revisi')->nullable();
            $table->date('tanggal_realisasi')->nullable();
            $table->string('tahun', 4)->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dipas');
    }
};
