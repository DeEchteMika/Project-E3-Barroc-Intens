<?php

use App\Http\Controllers\ProcessMailController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InkoopController;
use App\Http\Controllers\InkoopRegelController;
use App\Http\Controllers\FinancienController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/sales-dashboard', function () {
        return view('sales.sales-dashboard');
    })->name('sales.dashboard');

    Route::resource('customers', CustomerController::class)
        ->only(['index', 'create', 'store']);

    Route::get('/sales-create', [CustomerController::class, 'create'])
        ->name('sales.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('inkoop', [InkoopController::class, 'index'])->name('inkoop.index');
    Route::get('inkoop/create', [InkoopController::class, 'create'])->name('inkoop.create');
    Route::post('inkoop', [InkoopController::class, 'store'])->name('inkoop.store');
    Route::delete('inkoop/{product}', [InkoopController::class, 'destroy'])->name('inkoop.destroy');

    Route::get('financien', [FinancienController::class, 'index'])->name('financien.index');
    Route::get('financien/{klant}/edit', [FinancienController::class, 'edit'])->name('financien.edit');
    Route::get('financien/create', [FinancienController::class, 'create'])->name('financien.create');
    Route::post('financien', [FinancienController::class, 'store'])->name('financien.store');
    Route::put('financien/update', [FinancienController::class, 'update'])->name('financien.update');

    Route::get('/send-mail-test', [ProcessMailController::class, 'showForm'])->name('send.mail.form');
    Route::post('/send-mail-test', [ProcessMailController::class, 'send'])->name('send.mail.send');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('customers', CustomerController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

Route::get('/klantenservice', function () {
    return view('klantenservice.index');
})->name('klantenservice');

Route::get('/sales', function () {
    return view('sales.index');
})->name('sales');

Route::get('/klantenservice', function () {
    return view('klantenservice.index');
})->name('klantenservice');

Route::get('/onderhoud', function () {
    return view('onderhoud.index');
})->name('onderhoud');

Route::get('/management', function () {
    return view('management.index');
})->name('management');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');

require __DIR__.'/auth.php';
