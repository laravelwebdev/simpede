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
        Schema::create('spesifikasi_kerangka_acuans', function (Blueprint $table) {
            $table->id();
            $table->string('rincian', 80)->nullable();
            $table->integer('volume')->nullable()->unsigned();
            $table->string('satuan', 40)->nullable();
            $table->integer('harga_satuan')->nullable()->unsigned();
            $table->integer('total_harga')->nullable()->unsigned();
            $table->text('spesifikasi')->nullable();
            $table->mediumInteger('kerangka_acuan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesifikasi_kerangka_acuans');
    }
};
