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
        Schema::create('pengelolas', function (Blueprint $table) {
            $table->id();
            $table->string('role', 20)->nullable();
            $table->date('active')->nullable();
            $table->date('inactive')->nullable();
            $table->mediumInteger('user_id')->nullable()->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengelolas');
    }
};
