<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/login', 'AuthController@showLoginForm')->name('login');
Route::post('/login', 'AuthController@login')->name('login.post');
Route::post('/logout', 'AuthController@logout')->name('logout');

// Backend Routes
Route::middleware(['auth'])->group(function () {
    // Admin Routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/products', [AdminController::class, 'viewProducts'])->name('admin.products');
        Route::post('/admin/products/{id}/approve', [AdminController::class, 'approveProduct'])->name('admin.products.approve');
        Route::get('/admin/orders', [AdminController::class, 'viewOrders'])->name('admin.orders');
        Route::patch('/admin/orders/{id}/status', [AdminController::class, 'changeOrderStatus'])->name('admin.orders.status');
        Route::patch('/admin/orders/{id}/status', [AdminController::class, 'changeOrderStatus'])->name('admin.orders.status');
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });
    
    // Employee Routes
    Route::middleware(['employee'])->group(function () {
        Route::get('/employee/products/create', [EmployeeController::class, 'createProduct'])->name('employee.products.create');
        Route::post('/employee/products', [EmployeeController::class, 'storeProduct'])->name('employee.products.store');
    });
});

// Frontend Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

// Order Routes
Route::middleware(['auth', 'customer'])->group(function () {
    Route::post('/orders', [OrderController::class, 'placeOrder'])->name('orders.place');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', [AuthController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
