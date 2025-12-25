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
        Schema::table('arsip_dokumens', function (Blueprint $table) {
            $table->after('slug', function (Blueprint $table) {
                $table->date('tanggal_dokumen')->nullable();
                $table->tinyInteger('jumlah_halaman')->unsigned()->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsip_dokumens', function (Blueprint $table) {
            $table->dropColumn('tanggal_dokumen');
            $table->dropColumn('jumlah_halaman');
        });
    }
};
