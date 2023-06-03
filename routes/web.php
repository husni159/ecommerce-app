<?php
use Illuminate\Support\Facades\Route;

// Authentication Routes
// Route::get('/login', 'AuthController@showLoginForm')->name('login');
Route::post('/login', 'AuthController@login')->name('login.post');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::get('/login', 'AuthController@authPage')->name('login');

// Customer Routes
Route::middleware(['auth', 'customer'])->group(function () {
    // Place order
    Route::post('/orders', 'OrderController@store')->name('orders.store');
    // View orders
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    // View order details
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    
});

// Admin and Employee Routes
Route::middleware(['auth', 'admin_or_employee'])->group(function () {
    // Product Management
    Route::get('/products', 'ProductController@index')->name('products.index');
    Route::get('/products/create', 'ProductController@create')->name('products.create');
    Route::post('/products', 'ProductController@store')->name('products.store');

    // Order Management
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');

    Route::put('/orders/{order}', 'OrderController@updateStatus')->name('orders.updateStatus');
    // Dashborad
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Approve Products
    Route::post('/products/{id}/approve', 'ProductController@approve')->name('products.approve');
    // View all orders
    Route::get('/admin/orders', 'AdminController@viewOrders')->name('admin.orders');
});


//Front-end rotes
Route::get('/', 'AuthController@authPage')->name('authenticate');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout');
Route::post('/orders', 'OrderController@store')->name('orders.store');
Route::middleware('auth')->group(function () {
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/{id}', 'OrderController@show')->name('orders.show');
});
