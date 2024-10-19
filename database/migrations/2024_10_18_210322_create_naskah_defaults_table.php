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
        Schema::create('naskah_defaults', function (Blueprint $table) {
            $table->id();
            $table->string('jenis')->nullable();
            $table->text('kode_arsip_id')->nullable();
            $table->mediumInteger('jenis_naskah_id')->nullable()->unsigned();
            $table->mediumInteger('derajat_naskah_id')->nullable()->unsigned();
            $table->mediumInteger('tata_naskah_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naskah_defaults');
    }
};
