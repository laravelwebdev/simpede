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
        Schema::create('daftar_honor_mitras', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('volume')->nullable()->unsigned();
            $table->bigInteger('harga_satuan')->nullable()->unsigned();
            $table->bigInteger('persen_pajak')->nullable()->unsigned();
            $table->string('rekening', 40)->nullable();
            $table->string('bulan', 20)->nullable();
            $table->string('jenis', 20)->nullable();
            $table->bigInteger('mitra_id')->nullable()->unsigned();
            $table->bigInteger('honor_kegiatan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_honor_mitras');
    }
};
