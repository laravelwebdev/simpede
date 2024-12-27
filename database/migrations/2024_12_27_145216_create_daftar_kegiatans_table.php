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
        Schema::create('daftar_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 20)->nullable();
            $table->string('kegiatan', 100)->nullable();
            $table->mediumInteger('rapat_internal_id')->nullable()->unsigned();
            $table->dateTime('awal')->nullable();
            $table->dateTime('akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_kegiatans');
    }
};
