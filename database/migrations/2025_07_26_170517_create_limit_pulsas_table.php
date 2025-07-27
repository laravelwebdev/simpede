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
        Schema::create('limit_pulsas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 40)->nullable();
            $table->date('tanggal')->nullable();
            $table->mediumInteger('limit')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('limit_pulsas');
    }
};
