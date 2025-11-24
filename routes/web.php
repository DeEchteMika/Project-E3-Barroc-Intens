<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InkoopController;
use App\Http\Controllers\InkoopRegelController;
use App\Http\Controllers\FinancienController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/Management-Dashboard', function () {
    return view('dashboards.managementDashboard');
})->name('managementDashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sales-dashboard', function () {
    return view('sales');
})->middleware(['auth', 'verified'])->name('sales.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Simple product management for inkoop: list, create, store, destroy
    Route::get('inkoop', [InkoopController::class, 'index'])->name('inkoop.index');
    Route::get('inkoop/create', [InkoopController::class, 'create'])->name('inkoop.create');
    Route::post('inkoop', [InkoopController::class, 'store'])->name('inkoop.store');
    Route::delete('inkoop/{product}', [InkoopController::class, 'destroy'])->name('inkoop.destroy');

    // financien routes
    Route::get('financien', [FinancienController::class, 'index'])->name('financien.index');
    Route::get('financien/create', [FinancienController::class, 'create'])->name('financien.create');
    Route::post('financien', [FinancienController::class, 'store'])->name('financien.store');
    
});

require __DIR__.'/auth.php';
