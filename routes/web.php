<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductManagementController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/pos'); // Redirect root to /pos

Route::middleware(['auth'])->group(function () {
    Route::get('/pos', function () {
        return view('pos');
    })->name('pos');

    Route::get('/products', [ProductController::class, 'index']);

    Route::get('/manage-products', [ProductManagementController::class, 'index'])->name('products.manage');
    Route::get('/manage-products/create', [ProductManagementController::class, 'create'])->name('products.create');
    Route::post('/manage-products', [ProductManagementController::class, 'store'])->name('products.store');
    Route::get('/manage-products/{product}/edit', [ProductManagementController::class, 'edit'])->name('products.edit');
    Route::put('/manage-products/{product}', [ProductManagementController::class, 'update'])->name('products.update');
    Route::delete('/manage-products/{product}', [ProductManagementController::class, 'destroy'])->name('products.destroy');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
