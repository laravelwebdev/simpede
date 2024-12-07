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
        Schema::create('kak_sp2d', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('kerangka_acuan_id')->unsigned()->nullable();
            $table->mediumInteger('datar_sp2d_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kak_sp2d');
    }
};
