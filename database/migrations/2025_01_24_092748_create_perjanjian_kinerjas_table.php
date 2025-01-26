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
        Schema::create('perjanjian_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 4)->nullable();
            $table->string('tujuan')->nullable();
            $table->string('sasaran')->nullable();
            $table->string('indikator')->nullable();
            $table->decimal('target_tw1')->nullable()->unsigned();
            $table->decimal('target_tw2')->nullable()->unsigned();
            $table->decimal('target_tw3')->nullable()->unsigned();
            $table->decimal('target_tw4')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjanjian_kinerjas');
    }
};
