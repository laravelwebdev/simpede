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
        Schema::create('target_serapan_anggarans', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('bulan')->unsigned()->nullable();
            $table->string('jenis_belanja', 2)->nullable();
            $table->mediumInteger('dipa_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_serapan_anggarans');
    }
};
