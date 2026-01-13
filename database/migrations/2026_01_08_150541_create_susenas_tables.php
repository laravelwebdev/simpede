<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * TABLE: art.
         */
        Schema::create('art', function (Blueprint $table) {
            $table->id();
            $table->integer('nks')->nullable();
            $table->integer('r109')->nullable();
            $table->integer('r400')->nullable();
            $table->integer('r401')->nullable();
            $table->string('krt', 35)->nullable();
            $table->string('r402', 37)->nullable();
            $table->integer('r403')->nullable();
            $table->integer('r404')->nullable();
            $table->integer('r405')->nullable();
            $table->integer('r406a')->nullable();
            $table->integer('r406b')->nullable();
            $table->integer('r406c')->nullable();
            $table->integer('r407')->nullable();
            $table->integer('r408')->nullable();
            $table->integer('r409')->nullable();
            $table->string('r505', 40)->nullable();
            $table->integer('r610')->nullable();
            $table->integer('r611')->nullable();
            $table->integer('r612')->nullable();
            $table->integer('r613')->nullable();
            $table->integer('r614')->nullable();
            $table->integer('r615')->nullable();
            $table->timestamps();
        });

        /**
         * TABLE: cacah.
         */
        Schema::create('cacah', function (Blueprint $table) {
            $table->id();
            $table->string('prov', 2)->nullable();
            $table->string('kab', 2)->nullable();
            $table->string('nks', 9)->nullable();
            $table->integer('nus')->nullable();
            $table->integer('nus0324')->nullable();
            $table->string('krt', 50)->nullable();
            $table->string('krt0324', 40)->nullable();
            $table->string('kode_pcl', 40)->nullable();
            $table->string('pcl', 40)->nullable();
            $table->string('kode_pml', 40)->nullable();
            $table->string('pml', 40)->nullable();
            $table->integer('pendidikan')->nullable();
            $table->string('statusc', 5)->default('belum');
            $table->integer('p1c')->nullable();
            $table->integer('p2c')->nullable();
            $table->integer('p1p')->nullable();
            $table->integer('p2p')->nullable();
            $table->integer('p3p')->nullable();
            $table->integer('p4p')->nullable();
            $table->integer('p5p')->nullable();
            $table->integer('p1k')->nullable();
            $table->integer('p2k')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });

        /**
         * TABLE: rentang_harga.
         */
        Schema::create('rentang_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('no_urut');
            $table->string('nama', 255);
            $table->string('satuan', 50);
            $table->unsignedInteger('harga1');
            $table->unsignedInteger('harga2');
            $table->unsignedTinyInteger('fixed')->default(2);
            $table->timestamps();
        });

        /**
         * TABLE: updating.
         */
        Schema::create('updating', function (Blueprint $table) {
            $table->id();
            $table->string('prov', 2)->nullable();
            $table->string('kab', 2)->nullable();
            $table->string('nks', 10)->nullable();
            $table->string('kode_pcl', 40)->nullable();
            $table->string('pcl', 40)->nullable();
            $table->string('kode_pml', 40)->nullable();
            $table->string('pml', 40)->nullable();
            $table->string('statusc', 5)->default('belum');
            $table->integer('p1c')->nullable();
            $table->integer('p2c')->nullable();
            $table->integer('p3c')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('updating');
        Schema::dropIfExists('rentang_harga');
        Schema::dropIfExists('cacah');
        Schema::dropIfExists('art');
    }
};
