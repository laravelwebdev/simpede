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
        Schema::create('jenis_pulsas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 80)->nullable();
            $table->string('satuan', 80)->nullable();
            $table->integer('sbml')->nullable()->unsigned();
            $table->mediumInteger('limit_pulsa_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pulsas');
    }
};
