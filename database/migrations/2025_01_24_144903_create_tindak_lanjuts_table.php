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
        Schema::create('tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->string('triwulan', 1)->nullable();
            $table->string('tahun', 4)->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->date('deadline')->nullable();
            $table->text('penanggung_jawab')->nullable();
            $table->mediumInteger('unit_kerja_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjuts');
    }
};
