<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;      // ← Admin\ add
use App\Http\Controllers\Admin\BrandController;        // ← Admin\ add
use App\Http\Controllers\Admin\CategoryController;     // ← Admin\ add
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;




Route::get('/', [HomeController::class, 'index'])->name('home');
// product listing k lia
Route::get('/products-list', [FrontendProductController::class, 'index']);
Route::get('/products/{slug}', [FrontendProductController::class, 'show']);


Route::get('/orders', function () {
    return view('frontend.orders.index');
});

Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
    Route::get('/order/success/{id}', [OrderController::class, 'orderSuccess'])->name('order.success');
    Route::get('/orders', [OrderController::class, 'orderIndex'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'orderShow'])->name('orders.show');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index'); 
    Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');   
    Route::post('/initiate-razorpay', [CheckoutController::class, 'initiateRazorpay'])->name('checkout.initiate-razorpay');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('orders.cancel');
});
Route::prefix('admin')->middleware('admin')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    

});
require __DIR__.'/auth.php';