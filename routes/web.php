<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\SettingsController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('pages.about'); 
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact'); 
})->name('contact');

Route::get('/check', function () {
    return view('check'); 
})->name('check');

Route::get('/cek', function () {
    return view('cek'); 
})->name('cek');

// Shop route - accessible to all
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/quick-view/{id}', [ShopController::class, 'quickView'])->name('shop.quick-view');
Route::post('/shop/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('shop.add-to-cart');
Route::post('/shop/toggle-wishlist/{id}', [ShopController::class, 'toggleWishlist'])->name('shop.toggle-wishlist');

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    // Products
    Route::get('/dashboard/products/search', [ProductController::class, 'searchAndShow'])->name('dashboard.products.search');
    Route::get('/dashboard/products/{id}/data', [ProductController::class, 'getProductData'])->name('dashboard.products.data');
    Route::resource('dashboard/products', ProductController::class)->names('dashboard.products');

    // Transactions
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/{order}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::patch('/transactions/{order}/status', [TransactionController::class, 'updateStatus'])->name('transactions.update-status');
        Route::delete('/transactions/{order}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
        Route::get('/transactions/{order}/print', [TransactionController::class, 'print'])->name('transactions.print');

        // Customers
        Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    });
    
    // Settings Routes
    Route::get('/settings', [AdminSettingsController::class, 'edit'])->name('admin.settings');
    Route::put('/settings', [AdminSettingsController::class, 'update'])->name('admin.settings.update');
});

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'edit'])->name('profile.settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('profile.settings.update');

    // Cart management
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update/{product}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    
    // Checkout routes
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.process-checkout');
    Route::get('/order/success/{order}', [CartController::class, 'orderSuccess'])->name('order.success');
    
    // Customer orders routes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
        Route::get('/{order}/invoice', [OrderController::class, 'invoice'])->name('invoice');
        Route::get('/{order}/track', [OrderController::class, 'track'])->name('track');
        Route::post('/{order}/reorder', [OrderController::class, 'reorder'])->name('reorder');
        Route::get('/{order}/review', [OrderController::class, 'reviewForm'])->name('review.form');
        Route::post('/{order}/review', [OrderController::class, 'submitReview'])->name('review.submit');
    });

    // Alternative route for My Orders
    Route::get('/my-orders', [OrderController::class, 'index'])->name('my-orders');

    // Notification routes
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');
});

// Public product routes
Route::get('/products', [ProductController::class, 'customerIndex'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');