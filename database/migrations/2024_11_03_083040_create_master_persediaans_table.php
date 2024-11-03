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
        Schema::create('master_persediaans', function (Blueprint $table) {
            $table->id();
            $table->string('kode',20)->nullable()->unique();
            $table->string('barang')->nullable();
            $table->string('satuan',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_persediaans');
    }
};
