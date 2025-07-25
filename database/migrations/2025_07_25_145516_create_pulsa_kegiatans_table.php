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
            $table->string('kegiatan')->nullable();
            $table->string('bulan', 2)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->decimal('jam',5)->nullable()->unsigned();
            $table->mediumInteger('jumlah')->nullable()->unsigned();
            $table->mediumInteger('mitra_id')->nullable()->unsigned();
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
