<?php
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::post('/login', 'AuthController@login')->name('login.post');
Route::post('/logout', 'AuthController@logout')->name('logout');
Route::get('/login', 'AuthController@authPage')->name('login');

// Registration Routes
Route::get('/register', 'AuthController@showRegistrationForm')->name('register');
Route::post('/register', 'AuthController@register');

// Customer Routes
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/products/{id}', 'ProductController@show')->name('products.show');
    // Place order
    Route::post('/orders', 'OrderController@store')->name('orders.store');
    // View orders
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    // View order details
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/remove/{itemId}', 'CartController@remove')->name('cart.remove');
    Route::delete('/cart/clear', 'CartController@clear')->name('cart.clear');
    Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout');
    Route::post('/order/place', 'OrderController@orderPlace')->name('order.place');
    Route::post('/cart', 'CartController@store')->name('cart.store');
});

// Admin and employee and customer
Route::middleware(['auth', 'admin_or_employee_or_costomer'])->group(function () {
    Route::get('/products', 'ProductController@index')->name('products.index');
});

Route::middleware(['auth', 'admin_or_costomer'])->group(function () {
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
});

// Employee Routes

Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/employee/createproduct', 'EmployeeController@createProduct')->name('employee.products.create');
    Route::post('/products', 'ProductController@store')->name('products.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Approve Products
    Route::post('/products/{id}/approve', 'ProductController@approve')->name('products.approve');
    // View all orders
    Route::get('/admin/orders', 'AdminController@viewOrders')->name('admin.orders');
    Route::get('/admin/orders/{order}', 'AdminController@OrderShow')->name('admin.orders.show');
    Route::put('/orders/{order}', 'AdminController@changeOrderStatus')->name('orders.updateStatus'); 
    // Dashborad
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        
});

Route::get('/', 'AuthController@authPage')->name('authenticate');
Route::middleware('auth')->group(function () {
    Route::get('/orders/{id}', 'OrderController@show')->name('orders.show');
});
