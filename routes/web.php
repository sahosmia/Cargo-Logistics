<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});


// =============================  Fronted Pert ===============================
Route::get('/booking', [BookingController::class, 'index'])->name('customer.booking');


// ================================ Coustomer Panel =========================

// =============================== Admin Panel =-===========================


require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
