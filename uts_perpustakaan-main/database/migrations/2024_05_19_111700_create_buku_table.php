<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->increments('no_buku'); // Primary key
            $table->string('judul');
            $table->string('edisi');
            $table->unsignedInteger('no_rak');
            $table->date('tahun');
            $table->string('penerbit');
            $table->unsignedInteger('kd_penulis');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('no_rak')->references('kd_rak')->on('rak_buku')->onDelete('cascade');
            $table->foreign('kd_penulis')->references('kd_penulis')->on('penulis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
