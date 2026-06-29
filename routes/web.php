<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\PasswordController;


use App\Http\Controllers\Auth\ForgotPasswordController;


Route::get('/', [ProductController::class, 'userProducts']);

Route::get('/products', [ProductController::class, 'userProducts'])->name('products.list');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/user/dashboard', function () { 
    return view('user/dashboard');
    })->middleware('auth');

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
    
    Route::get('/cart-count', [CartController::class, 'count']);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/remove-cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::patch('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');
    Route::patch('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');
    Route::post('/buy-now/{id}', [CartController::class, 'buyNow'])->name('cart.buyNow');
});

Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/cart-count', [CartController::class, 'count']);

Route::middleware('auth')->group(function () {

    Route::get('/my-orders', [OrderController::class, 'myOrders']);
    Route::get('/order-details/{id}', [OrderController::class, 'orderDetails']);

    Route::get('/admin/orders/index', [OrderController::class, 'adminOrders']);
});


Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout')->middleware('auth');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/change-password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/change-password', [PasswordController::class, 'update'])->name('password.update');
});

Route::get('/otp', [AuthController::class, 'showOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/resend-otp', [AuthController::class, 'resendOtp']);



Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin/dashboard');
    });

    Route::get('/admin/unverified', [AdminController::class, 'unverified']);
    Route::get('/admin/verified', [AdminController::class, 'verified']);
    Route::get('/admin/inactive', [AdminController::class, 'inactive']);

    Route::get('/admin/approve-user/{id}', [AdminController::class, 'approveUser']);
    Route::get('/admin/inactivate-user/{id}', [AdminController::class, 'inactivateUser']);

    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::get('/admin/create', [CategoryController::class, 'create']);
    Route::post('/admin/categories', [CategoryController::class, 'store']);

    Route::get('/admin/categories/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/admin/categories/update/{id}', [CategoryController::class, 'update']);
    Route::get('/admin/categories/delete/{id}', [CategoryController::class, 'delete']);

    Route::get('/admin/products', [ProductController::class, 'index']);
    Route::get('/admin/products/create', [ProductController::class, 'create']);
    Route::post('/admin/products/store', [ProductController::class, 'store']);

    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/admin/products/update/{id}', [ProductController::class, 'update']);
    Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete']);

    Route::get('/admin/orders/index', [OrderController::class, 'adminOrders']);



     Route::post('/admin/activate-user', [AdminController::class, 'activateUserAjax'])->name('admin.activate-user-ajax');
});


Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('forgot.password.send');

Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('reset.password');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password.post');
