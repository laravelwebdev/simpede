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
            $table->after('tanggal_spm', function (Blueprint $table) {
                $table->date('tanggal_spp')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_sp2ds', function (Blueprint $table) {
            $table->dropColumn('tanggal_spp');
        });
    }
};
