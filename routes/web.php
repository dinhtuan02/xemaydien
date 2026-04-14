<?php

use Illuminate\Support\Facades\Route;

// User Controllers
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ReviewController as UserReviewController;
use App\Http\Controllers\User\WishlistController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\BannerController;

// =========================
// User Routes - Public
// =========================
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [UserProductController::class, 'show'])->name('products.show');
Route::get('/search', [UserProductController::class, 'search'])->name('products.search');

// =========================
// Auth Routes
// =========================
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}

// =========================
// User Routes - Protected
// =========================
Route::middleware(['auth', 'active'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{item}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    Route::get('/my-orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    Route::post('/my-orders/{order}/cancel', [UserOrderController::class, 'cancel'])->name('orders.cancel');

    Route::post('/reviews', [UserReviewController::class, 'store'])->name('reviews.store');

    Route::post('/buy-now/{product}', [CheckoutController::class, 'buyNow'])->name('checkout.buy-now');
    Route::post('/buy-now/process/{product}', [CheckoutController::class, 'processBuyNow'])->name('checkout.process-buy-now');
});

// =========================
// Admin Routes
// =========================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'active', 'admin'])
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('banners', BannerController::class);

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::put('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');

        Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
        Route::delete('/reviews/{review}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::put('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    });