<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->text('context')->nullable();
            $table->string('level')->nullable();
            $table->string('file')->nullable();
            $table->integer('line')->nullable();
            $table->boolean('resolved')->default(false);
            $table->unsignedInteger('count')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('error_logs');
    }
};
