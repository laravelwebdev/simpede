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
            $table->after('id_link', function (Blueprint $table) {
                $table->mediumInteger('kak_kode_arsip_id')->unsigned()->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerangka_acuans', function (Blueprint $table) {
            $table->dropColumn('kak_kode_arsip_id');
        });
    }
};
