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
        Schema::create('mata_anggarans', function (Blueprint $table) {
            $table->id();
            $table->string('mak', 40)->nullable();
            $table->smallInteger('coa_id')->nullable()->unsigned();
            $table->string('uraian', 255)->nullable();
            $table->string('jenis_belanja', 2)->nullable();
            $table->mediumInteger('volume')->nullable()->unsigned();
            $table->string('satuan', 20)->nullable();
            $table->integer('harga_satuan')->nullable()->unsigned();
            $table->integer('total')->nullable()->unsigned();
            $table->integer('blokir')->nullable()->unsigned();
            $table->integer('rpd_1')->nullable()->unsigned();
            $table->integer('rpd_2')->nullable()->unsigned();
            $table->integer('rpd_3')->nullable()->unsigned();
            $table->integer('rpd_4')->nullable()->unsigned();
            $table->integer('rpd_5')->nullable()->unsigned();
            $table->integer('rpd_6')->nullable()->unsigned();
            $table->integer('rpd_7')->nullable()->unsigned();
            $table->integer('rpd_8')->nullable()->unsigned();
            $table->integer('rpd_9')->nullable()->unsigned();
            $table->integer('rpd_10')->nullable()->unsigned();
            $table->integer('rpd_11')->nullable()->unsigned();
            $table->integer('rpd_12')->nullable()->unsigned();
            $table->mediumInteger('dipa_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_anggarans');
    }
};
