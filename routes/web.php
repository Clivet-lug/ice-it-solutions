<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/services/{service}/request', [ServiceController::class, 'request'])->name('services.request');
Route::post('/services/submit-request', [ServiceController::class, 'submitRequest'])->name('services.submit-request');

// Authentication Routes (provided by Laravel Breeze)
require __DIR__ . '/auth.php';

// Protected Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/contacts', [ContactController::class, 'list'])->name('contact.list');
    Route::get('/manage-services', [ServiceController::class, 'manage'])->name('services.manage');
});
