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
        Schema::create('derajat_naskahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10)->nullable();
            $table->string('derajat', 20)->nullable();
            $table->mediumInteger('tata_naskah_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('derajat_naskahs');
    }
};
