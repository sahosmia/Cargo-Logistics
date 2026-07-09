<?php

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:web,customer'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// =============================  Fronted Pert ===============================

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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
    Route::get('/booking', [BookingController::class, 'index'])->name('customer.booking');
    Route::post('/booking', [BookingController::class, 'store'])->name('customer.booking.store');
});

Route::middleware('auth:customer')->group(function () {
    Route::get('customer/dashboard', [DashboardController::class, 'index'])->name('customer.dashboard');
    Route::post('customer/logout', [CustomerLoginController::class, 'destroy'])->name('customer.logout');
});

// =============================== Admin Panel =-===========================

Route::middleware(['auth', 'verified'])->group(function () {

    // // --- Dashboard ---
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // // --- Customers ---
    // Route::prefix('customers')->name('customers.')->group(function () {
    //     Route::controller(CustomerController::class)->group(function () {
    //         Route::patch('{customer}/status', 'updateStatus')->name('update-status');
    //         Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
    //         Route::get('export/excel', 'export')->name('export');
    //         Route::get('print', 'print')->name('print');
    //         Route::post('import/excel', 'import')->name('import');
    //     });
    // });
    // Route::resource('customers', CustomerController::class);

    // // --- Products ---
    // Route::prefix('products')->name('products.')->group(function () {
    //     Route::controller(ProductController::class)->group(function () {
    //         Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
    //         Route::get('export/excel', 'export')->name('export');
    //         Route::get('print', 'print')->name('print');
    //         Route::post('import/excel', 'import')->name('import');
    //     });
    // });
    // Route::resource('products', ProductController::class);

    // // --- Follow Ups ---
    // Route::prefix('follow-ups')->name('follow-ups.')->group(function () {
    //     Route::controller(FollowUpController::class)->group(function () {
    //         Route::get('export/excel', 'export')->name('export');
    //         Route::get('print', 'print')->name('print');
    //         Route::patch('{follow_up}/status', 'updateStatus')->name('update-status');
    //         Route::post('{follow_up}/complete', 'complete')->name('complete');
    //         Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
    //     });
    // });
    // Route::resource('follow-ups', FollowUpController::class);

    // // --- Meetings ---
    // Route::prefix('meetings')->name('meetings.')->group(function () {
    //     Route::controller(MeetingController::class)->group(function () {
    //         Route::get('calendar', 'calendar')->name('calendar');
    //         Route::patch('{meeting}/status', 'updateStatus')->name('update-status');
    //         Route::get('export/excel', 'export')->name('export');
    //         Route::get('print', 'print')->name('print');
    //         Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
    //     });
    // });
    // Route::resource('meetings', MeetingController::class);

    // // --- Requirements ---
    // Route::prefix('requirements')->name('requirements.')->group(function () {
    //     Route::controller(RequirementController::class)->group(function () {
    //         Route::get('export/excel', 'export')->name('export');
    //         Route::get('print', 'print')->name('print');
    //         Route::get('{requirement}/download', 'downloadPdf')->name('download');
    //         Route::patch('{requirement}/status', 'updateStatus')->name('update-status');
    //         Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
    //     });
    // });
    // Route::resource('requirements', RequirementController::class);

    // // --- Reports ---
    // Route::prefix('reports')->name('reports.')->controller(ReportController::class)->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('follow-ups', 'followUps')->name('follow-ups');
    //     Route::get('customers', 'customers')->name('customers');
    // });

    // // --- Limited Resources ---
    // Route::prefix('companies')->name('companies.')->group(function () {
    //     Route::controller(CompanyController::class)->group(function () {
    //         Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
    //     });
    // });
    // Route::resource('companies', CompanyController::class);

    // Route::prefix('units')->name('units.')->group(function () {
    //     Route::controller(UnitController::class)->group(function () {
    //         Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
    //     });
    // });
    // Route::resource('units', UnitController::class)->except(['show']);

    // --- Administration ---
    // Route::middleware(['role:super_admin'])->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::delete('bulk-destroy', 'bulkDestroy')->name('bulkDestroy');
        });
    });
    Route::resource('users', UserController::class);

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

    // Global Settings
    Route::get('admin-settings', [SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('admin-settings', [SettingsController::class, 'update'])->name('admin.settings.update');
    // });
});

Route::get('/run-command/{command}', function ($command) {
    Artisan::call($command);

    return Artisan::output();
})->name('run-command.dynamic');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
