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
        Schema::create('rapat_internals', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('tujuan', '80')->nullable();
            $table->string('tema', '80')->nullable();
            $table->date('tanggal_rapat')->nullable();
            $table->time('mulai', precision: 0)->nullable();
            $table->string('tempat', '80')->nullable();
            $table->text('agenda')->nullable(); 
            $table->text('peserta')->nullable(); 
            $table->string('draft_notula')->nullable();
            $table->string('signed_notula')->nullable();
            $table->string('signed_daftar_hadir')->nullable();
            $table->string('signed_undangan')->nullable();
            $table->tinyInteger('baris')->nullable()->unsigned();
            $table->mediumInteger('kasubbag_user_id')->nullable()->unsigned();
            $table->mediumInteger('pimpinan_user_id')->nullable()->unsigned();
            $table->mediumInteger('kepala_user_id')->nullable()->unsigned();
            $table->mediumInteger('notulis_user_id')->nullable()->unsigned();
            $table->mediumInteger('naskah_keluar_id')->nullable()->unsigned();
            $table->fullText('agenda')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapat_internals');
    }
};
