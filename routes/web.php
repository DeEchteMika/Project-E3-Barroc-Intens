<?php

use App\Http\Controllers\ProcessMailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InkoopController;
use App\Http\Controllers\InkoopRegelController;
use App\Http\Controllers\FinancienController;
use App\Http\Controllers\KlantenserviceController;
use App\Http\Controllers\MedewerkersController;
use App\Http\Controllers\StoringsContoller;
use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/sales-dashboard', 'sales.sales-dashboard')->name('sales.dashboard');
    Route::get('/sales-create', [CustomerController::class, 'create'])->name('sales.create');

    Route::resource('customers', CustomerController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('inkoop', [InkoopController::class, 'index'])->name('inkoop.index');
    Route::get('inkoop/create', [InkoopController::class, 'create'])->name('inkoop.create');
    Route::post('inkoop', [InkoopController::class, 'store'])->name('inkoop.store');
    Route::delete('inkoop/{product}', [InkoopController::class, 'destroy'])->name('inkoop.destroy');
    Route::get('inkoop/{product}/edit', [InkoopController::class, 'edit'])->name('inkoop.edit');
    Route::put('inkoop/{product}', [InkoopController::class, 'update'])->name('inkoop.update');

    Route::get('financien', [FinancienController::class, 'index'])->name('financien.index');
    Route::get('financien/create', [FinancienController::class, 'create'])->name('financien.create');
    Route::post('financien', [FinancienController::class, 'store'])->name('financien.store');
    Route::get('financien/{klant}/edit', [FinancienController::class, 'edit'])->name('financien.edit');
    Route::put('financien/{klant}', [FinancienController::class, 'update'])->name('financien.update');

    Route::view('/klantenservice', 'klantenservice.index')->name('klantenservice');
    Route::get('/klanten', [KlantenserviceController::class, 'index'])->name('klanten');
    Route::get('/klantenservice/{klant}/edit', [KlantenserviceController::class, 'edit'])->name('klantenservice.edit');
    Route::put('/klantenservice/{klant}', [KlantenserviceController::class, 'update'])->name('klantenservice.update');

    Route::get('/send-mail-test', [ProcessMailController::class, 'showForm'])->name('send.mail.form');
    Route::post('/send-mail-test', [ProcessMailController::class, 'send'])->name('send.mail.send');

    Route::view('/sales', 'sales.index')->name('sales');
    Route::view('/onderhoud', 'onderhoud.index')->name('onderhoud');
    Route::view('/management', 'management.index')->name('management');
    Route::view('/admin', 'admin.index')->name('admin');
    Route::resource('storingen', StoringsContoller::class)->only(['index', 'show', 'edit', 'update', 'create', 'destroy', 'store',])->parameter('storingen', 'storing');
    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [MedewerkersController::class, 'index'])->name('admin');
    Route::resource('medewerker', MedewerkersController::class);
});
});

// Route::get('financien/{klant}/edit', [FinancienController::class, 'editF'])->name('financien.edit');

require __DIR__.'/auth.php';
