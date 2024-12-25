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
        Schema::create('rate_transloks', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->nullable()->unsigned();
            $table->mediumInteger('sk_translok_id')->nullable()->unsigned();
            $table->mediumInteger('asal_master_wilayah_id')->nullable()->unsigned();
            $table->mediumInteger('tujuan_master_wilayah_id')->nullable()->unsigned();
            $table->mediumInteger('rate')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_transloks');
    }
};
