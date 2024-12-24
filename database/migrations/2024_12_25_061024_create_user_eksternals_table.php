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
        Schema::create('user_eksternals', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('pangkat', 30)->nullable();
            $table->string('golongan', 40)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('rekening', 40)->nullable();
            $table->mediumInteger('kode_bank_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_eksternals');
    }
};
