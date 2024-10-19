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
        Schema::create('daftar_kontrak_mitras', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('kontrak_naskah_keluar_id')->unsigned()->nullable();
            $table->mediumInteger('bast_naskah_keluar_id')->unsigned()->nullable();
            $table->smallInteger('jumlah_kegiatan')->unsigned()->nullable();
            $table->mediumInteger('nilai_kontrak')->unsigned()->nullable();
            $table->boolean('valid_sbml')->nullable();
            $table->boolean('valid_jumlah_kontrak')->nullable();
            $table->mediumInteger('mitra_id')->unsigned()->nullable();
            $table->mediumInteger('kontrak_mitra_id')->unsigned()->nullable();
            $table->mediumInteger('bast_mitra_id')->unsigned()->nullable();
            $table->string('status', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_kontrak_mitras');
    }
};
