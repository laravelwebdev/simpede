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
        Schema::create('permintaan_persediaans', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('naskah_keluar_id')->nullable()->unsigned();
            $table->date('tanggal_permintaan')->nullable();
            $table->date('tanggal_persetujuan')->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status', 20)->nullable();
            $table->string('arsip')->nullable();
            $table->mediumInteger('pbmn_user_id')->unsigned()->nullable();
            $table->mediumInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_persediaans');
    }
};
