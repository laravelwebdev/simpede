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
        Schema::table('kak_sp2d', function (Blueprint $table) {
            $table->after('catatan', function (Blueprint $table) {
                $table->boolean('rekap_bos')->default(false);
                $table->boolean('rekap_sirup')->default(false);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kak_sp2d', function (Blueprint $table) {
            $table->dropColumn('rekap_bos');
            $table->dropColumn('rekap_sirup');
        });
    }
};
