<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    ArticleController,
    Auth\AuthenticatedSessionController,
    Auth\ConfirmablePasswordController,
    Auth\EmailVerificationNotificationController,
    Auth\EmailVerificationPromptController,
    Auth\NewPasswordController,
    Auth\PasswordController,
    Auth\PasswordResetLinkController,
    Auth\RegisteredUserController,
    Auth\VerifyEmailController,
    BrandController,
    CartController,
    CategoryController,
    CheckoutController,
    ContactController,
    DashboardController,
    OrderController,
    PermissionController,
    ProductController,
    ProductFilterController,
    ProfileController,
    RoleController,
    SocialiteController,
    UserController,
    HomeController,
    OrderItemController
};

// Auth routes for guests
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Google Authentication
Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
});

// Dashboard with verified middleware
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified', 'admin'])->name('dashboard');
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'admin'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Permission routes
Route::resource('permissions', PermissionController::class)->except(['show']);



// Role routes
Route::resource('roles', RoleController::class)->except(['show']);

// Article routes
Route::resource('articles', ArticleController::class)->except(['show']);

// User routes
// Route::resource('users', UserController::class)->except(['show']);
Route::resource('users', UserController::class)->except(['show']);


// Product routes
Route::resource('products', ProductController::class)->except(['show']);
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');

// Category routes
Route::resource('categories', CategoryController::class)->except(['show']);
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


// Brand routes
// Route::resource('brands', BrandController::class)->except(['show']);
Route::resource('brands', BrandController::class); // no need for "except"


// Product Filter
Route::get('/filter', [ProductFilterController::class, 'index'])->name('filter.index');

// Cart routes
Route::prefix('cart')->group(function () {
    Route::post('/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/{id}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('cart/checkoutSelected', [CartController::class, 'checkoutSelected'])->name('cart.checkoutSelected');

});

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/place-order', [CartController::class, 'placeorder'])->name('cart.placeorder');
Route::get('/checkout-cancel', [CartController::class, 'checkoutCancel'])->name('checkout.cancel');
Route::get('/checkout/success', [CartController::class, 'checkoutSuccess'])->name('checkout.success');

// Frontend static pages
// Route::view('/', 'frontend.pages.index');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'frontend.pages.about');
Route::view('/service', 'frontend.pages.service');
Route::view('/master', 'frontend.layout.master');
Route::view('/content', 'frontend.layout.content');
Route::get('/contact', function () {
    return view('frontend.pages.contact');
})->name('contact.form');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// Thank You page
Route::view('/thankyou', 'thankyou')->name('thankyou');
/////order route
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
Route::get('/order-items', [OrderItemController::class, 'index'])->name('order-items.index');
// Require additional auth routes if needed
require __DIR__ . '/auth.php';


