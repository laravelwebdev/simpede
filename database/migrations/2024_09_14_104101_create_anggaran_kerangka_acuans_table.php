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
        Schema::create('anggaran_kerangka_acuans', function (Blueprint $table) {
            $table->id();
            $table->integer('perkiraan')->nullable()->unsigned();
            $table->mediumInteger('mata_anggaran_id')->unsigned()->nullable();
            $table->mediumInteger('kerangka_acuan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggaran_kerangka_acuans');
    }
};
