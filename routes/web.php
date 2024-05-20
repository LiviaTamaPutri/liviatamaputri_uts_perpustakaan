<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/rak',\App\Http\Controllers\RakBukuController::class);
Route::resource('/buku',\App\Http\Controllers\BukuController::class);
Route::resource('/penulis',\App\Http\Controllers\PenulisController::class);

