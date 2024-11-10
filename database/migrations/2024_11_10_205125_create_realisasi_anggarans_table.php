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
        Schema::create('realisasi_anggarans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_sp2d')->nullable();
            $table->string('nomor_spp', 10)->nullable();
            $table->string('nomor_sp2d', 20)->nullable();
            $table->text('uraian', 20)->nullable();
            $table->smallInteger('coa_id')->nullable()->unsigned();
            $table->integer('nilai')->nullable();
            $table->mediumInteger('dipa_id')->nullable()->unsigned();
            $table->fullText('uraian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_anggarans');
    }
};
