<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokinController;
use App\Http\Controllers\StokoutController;
use App\Http\Controllers\UserController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard1', function () {
        return view('dashboard1');
    })->name('dashboard1');
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes
    Route::resource('produk', ProdukController::class);
    Route::resource('stokins', StokinController::class);
    Route::resource('stokouts', StokoutController::class);
});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [ProfileController::class, 'index'])->name('user.index');
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('user.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('user.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('user.destroy');
});

require __DIR__.'/auth.php';
