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
        Schema::create('mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('rekening', 40)->nullable();
            $table->string('npwp', 40)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('telepon', 30)->nullable();
            $table->string('idsobat', 30)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->mediumInteger('kepka_mitra_id')->nullable()->unsigned();
            $table->mediumInteger('kode_bank_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitras');
    }
};
