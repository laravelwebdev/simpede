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
        Schema::table('daftar_sp2ds', function (Blueprint $table) {
            $table->after('arsip_drpp', function (Blueprint $table) {
                $table->string('arsip_lampiran_spp')->nullable();
                $table->string('arsip_dpt')->nullable();
                $table->date('tanggal_spm')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_sp2ds', function (Blueprint $table) {
            $table->dropColumn('arsip_lampiran_spp');
            $table->dropColumn('arsip_dpt');
            $table->dropColumn('tanggal_spm');
        });
    }
};
