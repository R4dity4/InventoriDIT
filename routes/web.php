<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokinController;
use App\Http\Controllers\StokoutController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes
    Route::resource('produk', App\Http\Controllers\ProdukController::class);
    Route::resource('stokins', App\Http\Controllers\StokinController::class);
    Route::resource('stokouts', App\Http\Controllers\StokoutController::class);
});

require __DIR__.'/auth.php';
