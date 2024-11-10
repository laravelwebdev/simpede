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
        Schema::create('kamus_anggarans', function (Blueprint $table) {
            $table->id();
            $table->string('mak')->nullable();
            $table->string('detail')->nullable();
            $table->mediumInteger('dipa_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamus_anggarans');
    }
};
