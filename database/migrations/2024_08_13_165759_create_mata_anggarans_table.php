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
            $table->mediumInteger('volume')->nullable()->unsigned();
            $table->string('satuan', 20)->nullable();
            $table->integer('harga_satuan')->nullable()->unsigned();
            $table->integer('total')->nullable()->unsigned();
            $table->integer('blokir')->nullable()->unsigned();
            $table->integer('rpd_januari')->nullable()->unsigned();
            $table->integer('rpd_februari')->nullable()->unsigned();
            $table->integer('rpd_maret')->nullable()->unsigned();
            $table->integer('rpd_april')->nullable()->unsigned();
            $table->integer('rpd_mei')->nullable()->unsigned();
            $table->integer('rpd_juni')->nullable()->unsigned();
            $table->integer('rpd_juli')->nullable()->unsigned();
            $table->integer('rpd_agustus')->nullable()->unsigned();
            $table->integer('rpd_september')->nullable()->unsigned();
            $table->integer('rpd_oktober')->nullable()->unsigned();
            $table->integer('rpd_november')->nullable()->unsigned();
            $table->integer('rpd_desember')->nullable()->unsigned();
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
