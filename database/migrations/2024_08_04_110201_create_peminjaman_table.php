<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('id_peminjaman'); // Primary key
            $table->unsignedInteger('no_buku'); // Foreign key
            $table->unsignedInteger('id_anggota'); // Foreign key
            $table->date('tgl_peminjaman');
            $table->date('tgl_pengembalian')->nullable();
            $table->enum('status', ['Kembali', 'Belum']);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('no_buku')->references('no_buku')->on('buku');
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
