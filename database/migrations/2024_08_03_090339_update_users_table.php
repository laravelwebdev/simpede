<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('id', function (Blueprint $table) {
                $table->string('avatar')->nullable();
                $table->string('nip', 20)->nullable();
                $table->string('nip_lama', 10)->nullable();
            });
            $table->after('nip', function (Blueprint $table) {
                $table->mediumInteger('kode_bank_id')->nullable()->unsigned();
                $table->string('rekening', 40)->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['avatar', 'nip']);
        });
    }
};
