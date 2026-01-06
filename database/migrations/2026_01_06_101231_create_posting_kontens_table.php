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
        Schema::create('posting_kontens', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 20)->nullable();
            $table->string('kegiatan')->nullable();
            $table->string('prioritas', 20)->nullable();
            $table->mediumInteger('user_id')->nullable()->unsigned();
            $table->date('tanggal')->nullable();
            $table->string('status', 20)->nullable();
            $table->text('reminder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posting_kontens');
    }
};
