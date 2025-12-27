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
            $table->after('status_arsip', function (Blueprint $table) {
                $table->string('id_link')->nullable()->unique();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerangka_acuans', function (Blueprint $table) {
            $table->dropColumn('id_link');
        });
    }
};
