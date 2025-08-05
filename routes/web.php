<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\TestNotificationController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/products', [PagesController::class, 'allProducts'])->name('products.all');
Route::get('/search', [PagesController::class, 'search'])->name('search');
Route::get('/search-suggestions', [PagesController::class, 'searchSuggestions'])->name('search.suggestions');
Route::get('/viewproduct/{id}', [PagesController::class, 'viewProduct'])->name('viewproduct');
Route::get('/categoryproducts/{id}', [PagesController::class, 'categoryProducts'])->name('categoryproducts');
Route::get('/about', [PagesController::class, 'about'])->name('about');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/test-alerts', [PagesController::class, 'testAlerts'])->name('test.alerts');

// Test notification routes (for development only)
Route::get('/test/notification/order-placed', [TestNotificationController::class, 'testOrderPlaced']);
Route::get('/test/notification/order-status-updated', [TestNotificationController::class, 'testOrderStatusUpdated']);
Route::get('/test/notification/order-cancelled', [TestNotificationController::class, 'testOrderCancelled']);

// Auth routes
Route::middleware('auth')->group(function () {
    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Review routes
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

// Admin routes
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'isadmin'])->name('dashboard');

Route::middleware(['auth', 'isadmin'])->group(function () {
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/admin/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/admin/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/admin/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/admin/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/admin/products/{id}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');

    // Admin Order Routes
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/admin/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('/admin/orders/{id}/edit', [AdminOrderController::class, 'edit'])->name('admin.orders.edit');
    Route::patch('/admin/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.update-status');
    Route::delete('/admin/orders/{id}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
});

require __DIR__.'/auth.php';
