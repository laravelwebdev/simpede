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
            $table->smallInteger('volume_target')->nullable()->unsigned();
            $table->smallInteger('volume_realisasi')->nullable()->unsigned();
            $table->string('status_realisasi', 40)->nullable();
            $table->mediumInteger('harga_satuan')->nullable()->unsigned();
            $table->decimal('persen_pajak', 5)->nullable()->unsigned();
            $table->mediumInteger('mitra_id')->nullable()->unsigned();
            $table->mediumInteger('honor_kegiatan_id')->nullable()->unsigned();
            $table->mediumInteger('daftar_kontrak_mitra_id')->nullable()->unsigned();
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
