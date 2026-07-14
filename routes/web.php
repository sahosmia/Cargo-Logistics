<?php

use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:web,customer'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/dashboard/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/dashboard/bookings/{booking}/invoice', [BookingController::class, 'invoice'])->name('bookings.invoice');
    Route::patch('/dashboard/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.update-status');
});

// =============================  Fronted Pert ===============================

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/return-refund', [FrontendController::class, 'returnRefund'])->name('return.refund');
Route::get('/terms-conditions', [FrontendController::class, 'termsConditions'])->name('terms.conditions');

Route::get('/api/search-categories', [BookingController::class, 'getCategories'])->name('api.search-categories');
Route::get('/api/search-districts', [BookingController::class, 'getDistricts'])->name('api.search-districts');

// ================================ Coustomer Panel =========================
use App\Http\Controllers\Auth\CustomerLoginController;

Route::middleware('guest:customer,web')->group(function () {
    Route::get('customer-login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
    Route::post('customer-login/otp', [CustomerLoginController::class, 'requestOTP'])->name('customer.login.otp');
    Route::post('customer-login/verify', [CustomerLoginController::class, 'verifyOTP'])->name('customer.login.verify');
});

Route::middleware('auth:customer,web')->group(function () {
    Route::get('/booking', [BookingController::class, 'create'])->name('customer.booking');
    Route::post('/booking', [BookingController::class, 'store'])->name('customer.booking.store');
});

Route::middleware('auth:customer')->group(function () {
    Route::get('customer/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');
    Route::post('customer/logout', [CustomerLoginController::class, 'destroy'])->name('customer.logout');
});

// =============================== Admin Panel =-===========================

Route::middleware(['auth', 'verified'])->group(function () {

    // --- Administration ---
    // Route::middleware(['role:super_admin'])->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
        });
    });
    Route::resource('users', UserController::class);

    // --- Roles ---
    Route::resource('roles', RoleController::class);

    // --- Categories ---
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
        });
    });
    Route::resource('categories', CategoryController::class);

    // --- Districts ---
    Route::prefix('districts')->name('districts.')->group(function () {
        Route::controller(DistrictController::class)->group(function () {
            Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
        });
    });
    Route::resource('districts', DistrictController::class);

    // Contacts
    Route::get('contacts', [AdminContactController::class, 'index'])->name('admin.contacts.index');

    // Global Settings
    Route::get('admin-settings', [SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('admin-settings', [SettingsController::class, 'update'])->name('admin.settings.update');
    // });
});

Route::get('/run-command/{command}', function ($command) {
    Artisan::call($command);

    return Artisan::output();
})->name('run-command.dynamic');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
