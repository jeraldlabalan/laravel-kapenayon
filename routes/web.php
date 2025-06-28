<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Authentication Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Product Page Routes
Route::get('products/product-single/{id}', [App\Http\Controllers\Products\ProductsController::class, 'singleProduct'])->name('product.single');
