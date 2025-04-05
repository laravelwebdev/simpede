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
        Schema::table('daftar_kontrak_mitras', function (Blueprint $table) {
            $table->after('id', function (Blueprint $table) {
                $table->date('awal_kontrak')->nullable();
                $table->date('akhir_kontrak')->nullable();
                $table->date('tanggal_spk')->nullable();
                $table->mediumInteger('spk_ppk_user_id')->nullable()->unsigned();
                $table->mediumInteger('spk_kode_arsip_id')->nullable()->unsigned();
                $table->date('tanggal_bast')->nullable();
                $table->mediumInteger('bast_ppk_user_id')->nullable()->unsigned();
                $table->mediumInteger('bast_kode_arsip_id')->nullable()->unsigned();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_kontrak_mitras', function (Blueprint $table) {
            $table->dropColumn('awal_kontrak');
            $table->dropColumn('akhir_kontrak');
            $table->dropColumn('tanggal_spk');
            $table->dropColumn('spk_ppk_user_id');
            $table->dropColumn('spk_kode_arsip_id');
            $table->dropColumn('tanggal_bast');
            $table->dropColumn('bast_ppk_user_id');
            $table->dropColumn('bast_kode_arsip_id');
        });
    }
};