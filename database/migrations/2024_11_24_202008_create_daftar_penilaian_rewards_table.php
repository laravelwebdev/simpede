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
        Schema::create('daftar_penilaian_rewards', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('nilai_skp')->nullable()->unsigned();
            $table->tinyInteger('tk')->nullable()->unsigned();
            $table->tinyInteger('tl1')->nullable()->unsigned();
            $table->tinyInteger('tl2')->nullable()->unsigned();
            $table->tinyInteger('tl3')->nullable()->unsigned();
            $table->tinyInteger('tl4')->nullable()->unsigned();
            $table->tinyInteger('psw1')->nullable()->unsigned();
            $table->tinyInteger('psw2')->nullable()->unsigned();
            $table->tinyInteger('psw3')->nullable()->unsigned();
            $table->tinyInteger('psw4')->nullable()->unsigned();
            $table->tinyInteger('jumlah_butir')->nullable()->unsigned();
            $table->decimal('nilai_kinerja', 5)->nullable()->unsigned();
            $table->decimal('nilai_disiplin', 5)->nullable()->unsigned();
            $table->decimal('nilai_beban', 5)->nullable()->unsigned();
            $table->decimal('nilai_total', 5)->nullable()->unsigned();
            $table->mediumInteger('user_id')->nullable()->unsigned();
            $table->mediumInteger('reward_pegawai_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_penilaian_rewards');
    }
};
