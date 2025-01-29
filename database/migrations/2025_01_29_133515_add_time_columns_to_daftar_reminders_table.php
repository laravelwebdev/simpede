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
        Schema::table('daftar_reminders', function (Blueprint $table) {
            $table->time('waktu_kirim')
                ->after('tanggal')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftar_reminders', function (Blueprint $table) {
            $table->dropColumn([
                'waktu_kirim',
            ]);
        });
    }
};
