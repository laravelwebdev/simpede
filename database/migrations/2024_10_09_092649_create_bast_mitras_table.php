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
        Schema::create('bast_mitras', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_bast')->nullable();
            $table->string('status', 20)->nullable();
            $table->mediumInteger('kode_arsip_id')->nullable()->unsigned();
            $table->mediumInteger('ppk_user_id')->nullable()->unsigned();
            $table->mediumInteger('kontrak_mitra_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bast_mitras');
    }
};
