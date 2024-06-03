<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php


Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class);
Route::resource('categories', CategoryController::class);
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/', [ProductController::class, 'welcome']); 



Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/request', [ProductController::class, 'requestProduct'])->name('products.request');

require __DIR__.'/auth.php';
