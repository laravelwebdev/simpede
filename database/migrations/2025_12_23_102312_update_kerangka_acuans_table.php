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
        Schema::table('kerangka_acuans', function (Blueprint $table) {
            $table->after('status', function (Blueprint $table) {
                $table->boolean('rekap_bos')->default(false);
                $table->boolean('rekap_sirup')->default(false);
                $table->text('catatan')->default('Belum Lengkap')->nullable();
                $table->string('status_arsip')->default('Proses Bayar');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerangka_acuans', function (Blueprint $table) {
            $table->dropColumn('rekap_bos');
            $table->dropColumn('rekap_sirup');
            $table->dropColumn('catatan');
            $table->dropColumn('status_arsip');
        });
    }
};
