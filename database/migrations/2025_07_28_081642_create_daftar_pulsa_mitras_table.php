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
        Schema::create('daftar_pulsa_mitras', function (Blueprint $table) {
            $table->id();
            $table->decimal('volume', 5)->nullable()->unsigned();
            $table->string('handphone', 20)->nullable();
            $table->mediumInteger('nominal')->nullable()->unsigned();
            $table->mediumInteger('harga')->nullable()->unsigned();
            $table->boolean('confirmed')->nullable()->default(false);
            $table->string('file')->nullable();
            $table->mediumInteger('pulsa_kegiatan_id')->nullable()->unsigned();
            $table->mediumInteger('mitra_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_pulsa_mitras');
    }
};
