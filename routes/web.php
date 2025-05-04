<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\PembiayaanController;
use Illuminate\Support\Facades\Route;
use App\Exports\PenjualanExport;
use App\Http\Controllers\DashboardController;
use Maatwebsite\Excel\Facades\Excel;

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
    Route::post('proyeks/{proyek}/add-customer', [ProyekController::class, 'addCustomer'])->name('proyeks.addCustomer');
    Route::delete('proyeks/{proyek}/remove-customer/{customer}', [ProyekController::class, 'removeCustomer'])->name('proyeks.removeCustomer');
    Route::put('proyeks/{proyek}/update-status', [ProyekController::class, 'updateStatus'])->name('proyeks.updateStatus');
    Route::resource('penjualans', PenjualanController::class);
    Route::resource('barangs', BarangController::class);
    Route::resource('pembiayaans', PembiayaanController::class);
    Route::get('/penjualans/export', [PenjualanController::class, 'export'])->name('penjualans.export');
    Route::get('/penjualans/{penjualan}/pdf', [PenjualanController::class, 'cetakPdf'])->name('penjualans.pdf');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
