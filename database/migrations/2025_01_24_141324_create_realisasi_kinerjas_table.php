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
        Schema::create('realisasi_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->string('komponen')->nullable();
            $table->decimal('target_tw1')->nullable()->unsigned();
            $table->decimal('target_tw2')->nullable()->unsigned();
            $table->decimal('target_tw3')->nullable()->unsigned();
            $table->decimal('target_tw4')->nullable()->unsigned();
            $table->decimal('realisasi_tw1')->nullable()->unsigned();
            $table->decimal('realisasi_tw2')->nullable()->unsigned();
            $table->decimal('realisasi_tw3')->nullable()->unsigned();
            $table->decimal('realisasi_tw4')->nullable()->unsigned();
            $table->text('keterangan_target')->nullable();
            $table->text('keterangan_realisasi_tw1')->nullable();
            $table->text('keterangan_realisasi_tw2')->nullable();
            $table->text('keterangan_realisasi_tw3')->nullable();
            $table->text('keterangan_realisasi_tw4')->nullable();
            $table->text('bukti_realisasi_tw1')->nullable();
            $table->text('bukti_realisasi_tw2')->nullable();
            $table->text('bukti_realisasi_tw3')->nullable();
            $table->text('bukti_realisasi_tw4')->nullable();
            $table->boolean('is_indikator')->nullable();
            $table->mediumInteger('perjanjian_kinerja_id')->nullable()->unsigned();
            $table->mediumInteger('unit_kerja_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_kinerjas');
    }
};
