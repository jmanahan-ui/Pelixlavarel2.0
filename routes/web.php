<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\SellerController;

// Home route — loads dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Product CRUD routes
Route::resource('products', ProductController::class);

// Receipt CRUD routes
Route::resource('receipts', ReceiptController::class);

// Seller CRUD routes
Route::resource('sellers', SellerController::class);
