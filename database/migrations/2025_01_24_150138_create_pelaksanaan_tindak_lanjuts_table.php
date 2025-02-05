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
        Schema::create('pelaksanaan_tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->string('bulan', 2)->nullable();
            $table->text('kegiatan')->nullable();
            $table->text('bukti_dukung')->nullable();
            $table->mediumInteger('tindak_lanjut_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaksanaan_tindak_lanjuts');
    }
};
