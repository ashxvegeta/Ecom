<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;

//Auth API complete
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/cart',[CartController::class,'index']);
    Route::post('/cart/sync',[CartController::class,'sync']);
    Route::post('/cart/remove/{id}',[CartController::class,'removeFromCart']);
    Route::post('/orders', [OrderController::class, 'placeOrder']);
    Route::get('/orderslist', [OrderController::class, 'orderList']);
    Route::get('/ordersdetails/{id}', [OrderController::class, 'orderDetails']);
});

// products API

// products list 
Route::get('/products', [ProductController::class, 'index']);
// product details
Route::get('/products/{slug}', [ProductController::class, 'show']);

// category API 
Route::get('/categories', [CategoryController::class, 'index']);
// brand API
Route::get('/brands', [BrandController::class, 'index']);



