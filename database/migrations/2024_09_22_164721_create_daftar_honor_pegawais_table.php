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
        Schema::create('daftar_honor_pegawais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jumlah')->nullable()->unsigned();
            $table->bigInteger('satuan')->nullable()->unsigned();
            $table->bigInteger('bruto')->nullable()->unsigned();
            $table->bigInteger('pajak')->nullable()->unsigned();
            $table->bigInteger('netto')->nullable()->unsigned();
            $table->string('bulan', 20)->nullable();
            $table->string('jenis', 20)->nullable();
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->bigInteger('honor_kegiatan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_honor_pegawais');
    }
};
