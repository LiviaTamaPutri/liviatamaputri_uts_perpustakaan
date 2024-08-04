<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sanksi', function (Blueprint $table) {
            $table->increments('id_sanksi'); // Primary key
            $table->unsignedInteger('id_anggota'); // Foreign key
            $table->unsignedInteger('id_peminjaman'); // Foreign key
            $table->integer('jumlah_denda');
            $table->enum('status', ['Tunggakan', 'Lunas']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota');
            $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanksi');
    }
};
