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
        Schema::create('respon_rates', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 4)->nullable();
            $table->string('survei')->nullable();
            $table->string('jenis', 30)->nullable();
            $table->mediumInteger('target')->unsigned()->nullable();
            $table->mediumInteger('realisasi_tw1')->unsigned()->nullable();
            $table->mediumInteger('realisasi_tw2')->unsigned()->nullable();
            $table->mediumInteger('realisasi_tw3')->unsigned()->nullable();
            $table->mediumInteger('realisasi_tw4')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respon_rates');
    }
};
