<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\DB;

// Database test route
Route::get('/test-db', function () {
    try {
        $drivers = PDO::getAvailableDrivers();
        return "Available PDO drivers: " . implode(', ', $drivers);
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// Main routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/services', [ServiceController::class, 'index'])->name('services');

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/contacts', [ContactController::class, 'list'])->name('contact.list');
    Route::get('/contacts/export', [ContactController::class, 'export'])->name('contact.export');
    Route::post('/contacts/{contact}/mark-as-read', [ContactController::class, 'markAsRead'])->name('contact.markAsRead');
    Route::post('/contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contact.updateStatus');
});
