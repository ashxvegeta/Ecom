<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home.index');
});

Route::get('/products-list', function () {
    return view('frontend.products.index');
});

Route::get('/products/{id}', function ($id) {
    return view('frontend.products.show');
});

Route::get('/cart', function () {
    return view('frontend.cart.index');
});

Route::get('/checkout', function () {
    return view('frontend.checkout.index');
});

Route::get('/orders', function () {
    return view('frontend.orders.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::resource('products', ProductController::class);
Route::resource('brands', BrandController::class);
Route::resource('categories', CategoryController::class);

require __DIR__.'/auth.php';