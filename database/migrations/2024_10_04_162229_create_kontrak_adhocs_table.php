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
        Schema::create('kontrak_adhocs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kontrak')->nullable();
            $table->date('tanggal_spk')->nullable();
            $table->string('status', 30)->nullable();
            $table->bigInteger('ppk_user_id')->nullable()->unsigned();
            $table->bigInteger('honor_kegiatan_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_adhocs');
    }
};
