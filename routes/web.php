<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PricingRequestController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\AdminPricingController;
use App\Http\Controllers\Admin\AdminRequestController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPricingRequestController;


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

// Pricing Request routes
Route::get('/pricing/{pricing}/request', [PricingRequestController::class, 'create'])->name('pricing.request');
Route::post('/pricing/submit-request', [PricingRequestController::class, 'store'])->name('pricing.submit-request');


// Authentication Routes (provided by Laravel Breeze)
require __DIR__ . '/auth.php';

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Contact routes
    Route::get('/contacts', [ContactController::class, 'list'])->name('contact.list');
    Route::get('/contacts/export', [ContactController::class, 'export'])->name('contact.export'); // Add this line
    Route::get('/contacts/{contact}', [ContactController::class, 'adminshow'])->name('contact.show');
    Route::patch('/contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contact.update-status');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy');
    Route::post('/contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contact.mark-read');

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

    // Pricing Request routes
    Route::get('/pricing-requests', [AdminPricingRequestController::class, 'index'])->name('pricing-requests.index');
    Route::get('/pricing-requests/{request}', [AdminPricingRequestController::class, 'show'])->name('pricing-requests.show');
    Route::patch('/pricing-requests/{request}/status', [AdminPricingRequestController::class, 'updateStatus'])->name('pricing-requests.update-status');
});