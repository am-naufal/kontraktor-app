<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => 'Halo Admin');
});
Route::middleware(['auth', 'role:super_admin,admin'])->group(function () {
    Route::resource('/users', \App\Http\Controllers\UserController::class);
    Route::resource('proyeks', \App\Http\Controllers\ProyekController::class);
    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
