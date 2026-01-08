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
        Schema::create('susenas_fiturs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fitur', 30)->nullable();
            $table->string('path')->nullable();
            $table->longText('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('susenas_fiturs');
    }
};
