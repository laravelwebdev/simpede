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
            $table->after('daftar_sp2d_id', function (Blueprint $table) {
                $table->mediumInteger('arsip_keuangan_id')->unsigned()->nullable();
                $table->text('catatan')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kak_sp2d', function (Blueprint $table) {
            $table->dropColumn('arsip_keuangan_id');
            $table->dropColumn('catatan');
        });
    }
};
