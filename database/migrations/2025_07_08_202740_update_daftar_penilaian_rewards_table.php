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
        Schema::table('daftar_penilaian_rewards', function (Blueprint $table) {
            $table->after('nilai_skp', function (Blueprint $table) {
                $table->decimal('nilai_perilaku')->nullable()->unsigned();
                $table->tinyInteger('hk')->nullable()->unsigned();
                $table->tinyInteger('hd')->nullable()->unsigned();
                $table->tinyInteger('cst')->nullable()->unsigned();
                $table->tinyInteger('tb')->nullable()->unsigned();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_penilaian_rewards', function (Blueprint $table) {
            $table->dropColumn('nilai_perilaku');
            $table->dropColumn('hk');
            $table->dropColumn('hd');
            $table->dropColumn('cst');
            $table->dropColumn('tb');
        });
    }
};
