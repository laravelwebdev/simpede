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
        Schema::create('analisis_sakip_perjanjian_kinerja', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('perjanjian_kinerja_id')->nullable()->unsigned();
            $table->mediumInteger('analisis_sakip_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analisis_sakip_perjanjian_kinerja');
    }
};
