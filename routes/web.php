<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokinController;
use App\Http\Controllers\StokoutController;



Route::get('/', function () {
    return view('welcome');
});

// Route::get('produk', [ProdukController::class, 'index']);
// Route::get('produk.create', [ProdukController::class, 'create']);

Route::resource('produk', ProdukController::class);
Route::resource('stokins', StokinController::class);
Route::resource('stokout', StokoutController::class);
