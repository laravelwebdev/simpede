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
        Schema::table('daftar_kegiatans', function (Blueprint $table) {
            $table->after('rapat_internal_id', function (Blueprint $table) {
                $table->mediumInteger('posting_konten_id')->nullable()->unsigned();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_kegiatans', function (Blueprint $table) {
            $table->dropColumn('posting_konten_id');
        });
    }
};
