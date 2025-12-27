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
            $table->dropColumn('kerangka_acuan_id');
            $table->after('file', function (Blueprint $table) {
                $table->mediumInteger('kak_sp2d_id')->nullable()->unsigned();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsip_dokumens', function (Blueprint $table) {
            $table->after('file', function (Blueprint $table) {
                $table->mediumInteger('kerangka_acuan_id')->nullable()->unsigned();
            });
            $table->dropColumn('kak_sp2d_id');
        });
    }
};
