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
        Schema::create('target_serapan_anggarans', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('bulan')->unsigned()->nullable();
            $table->decimal('belanja51', 5)->nullable()->unsigned();
            $table->decimal('belanja52', 5)->nullable()->unsigned();
            $table->decimal('belanja53', 5)->nullable()->unsigned();
            $table->decimal('belanja54', 5)->nullable()->unsigned();
            $table->decimal('belanja55', 5)->nullable()->unsigned();
            $table->decimal('belanja56', 5)->nullable()->unsigned();
            $table->decimal('belanja57', 5)->nullable()->unsigned();
            $table->decimal('belanja58', 5)->nullable()->unsigned();
            $table->mediumInteger('dipa_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_serapan_anggarans');
    }
};
