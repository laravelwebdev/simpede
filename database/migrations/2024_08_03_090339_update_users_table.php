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
            $table->renameColumn('name', 'nama');
            $table->after('password', function (Blueprint $table) {
                $table->string('nip',30)->nullable();
                $table->string('pangkat',30)->nullable();
                $table->string('golongan',40)->nullable();
                $table->string('jabatan',50)->nullable();
                $table->bigInteger('unit_kerja_id')->nullable()->unsigned();
                $table->string('role',30)->nullable();
                $table->string('avatar')->nullable();
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
            $table->dropColumn(['nip', 'pangkat', 'golongan', 'jabatan', 'role', 'unit', 'avatar']);
        });
    }
};
