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
        Schema::create('sk_transloks', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 40)->nullable();
            $table->date('tanggal')->nullable();
            $table->string('tahun', 4)->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sk_transloks');
    }
};