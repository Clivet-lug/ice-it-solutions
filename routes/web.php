<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\AdminPricingController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminDashboardController;

// Public Routes

// Route::get('/services', function () {
//     try {
//         return view('services');
//     } catch (\Exception $e) {
//         Log::error($e->getMessage());
//         throw $e;
//     }
// });

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Service
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Service routes
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/services/{service}/request', [ServiceController::class, 'request'])->name('services.request');
Route::post('/services/submit-request', [ServiceController::class, 'submitRequest'])->name('services.submit-request');

// Portfolio routes
Route::get('/portfolio', [PortfolioController::class, 'publicIndex'])->name('portfolio.index');
Route::get('/portfolio/{portfolio}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Pricing routes
Route::get('/pricing', [App\Http\Controllers\PricingController::class, 'index'])->name('pricing.index');


// Authentication Routes (provided by Laravel Breeze)
require __DIR__ . '/auth.php';

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Contact
    Route::get('/contacts', [ContactController::class, 'list'])->name('contact.list');

    // Service and Requests
    Route::resource('services', AdminServiceController::class);
    Route::resource('requests', AdminRequestController::class);

    Route::post('requests/{request}/notes', [AdminRequestController::class, 'updateNotes'])
        ->name('requests.update-notes');
    Route::get(
        'requests/{request}/download/{attachmentIndex}',
        [AdminRequestController::class, 'downloadAttachment']
    )
        ->name('requests.download');

    // Portfolio
    Route::resource('portfolio', PortfolioController::class);

    // Pricing
    Route::resource('pricing', AdminPricingController::class);
});