<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kode_arsips', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->nullable();
            $table->string('group')->nullable();
            $table->string('detail')->nullable();
            $table->mediumInteger('tata_naskah_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kode_arsips');
    }
};
