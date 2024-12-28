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
        Schema::create('daftar_reminders', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('status', 20)->nullable();
            $table->string('message_id', 40)->nullable();
            $table->mediumInteger('daftar_kegiatan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_reminders');
    }
};
