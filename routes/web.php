<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/rak', \App\Http\Controllers\RakBukuController::class);
Route::resource('/buku', \App\Http\Controllers\BukuController::class);
Route::resource('/penulis', \App\Http\Controllers\PenulisController::class);
Route::resource('/anggota', \App\Http\Controllers\AnggotaController::class);
Route::resource('/peminjaman', \App\Http\Controllers\PeminjamanController::class);
Route::resource('/sanksi', \App\Http\Controllers\SanksiController::class);
