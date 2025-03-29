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
                $table->date('tanggal_spk')->nullable();
                $table->date('tanggal_bast')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_kontrak_mitras', function (Blueprint $table) {
            $table->dropColumn('tanggal_spk');
            $table->dropColumn('tanggal_bast');
        });
    }
};
