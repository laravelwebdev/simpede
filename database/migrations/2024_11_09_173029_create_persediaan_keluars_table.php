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
        Schema::create('persediaan_keluars', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('naskah_keluar_id')->nullable()->unsigned();
            $table->date('tanggal_dokumen')->nullable();
            $table->string('rincian')->nullable();
            $table->date('tanggal_buku')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persediaan_keluars');
    }
};
