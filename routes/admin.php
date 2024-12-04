<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Backend\BillingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ProductController;

// Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->group(function () {
    // Admin Dashboard All Routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'AdminDashboard')->name('admin.dashboard');
        // Admin User All Route
        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/user/ajax_load',  'Ajax_Load')->name('users.ajax_load');
        Route::get('/all/users', 'AllUsers')->name('all.users');
        Route::get('/add/admin', 'AddAdmin')->name('add.admin');
        Route::post('/store/admin', 'StoreAdmin')->name('store.admin');
        Route::get('/edit/admin/{id}', 'EditAdmin')->name('edit.admin');
        Route::put('/update/admin/{id}', 'UpdateAdmin')->name('update.admin');
        Route::post('/delete/admin', 'DeleteAdmin')->name('delete.admin');
    });

    // Category All Routes
    Route::resource('category', CategoryController::class);
    Route::post('/category/status', [CategoryController::class, 'StatusUpdate'])->name('category.status');
    Route::post('/category/delete', [CategoryController::class, 'Delete'])->name('category.delete');

     // Product All Routes
     Route::resource('products', ProductController::class);
     Route::post('/products/status', [ProductController::class, 'StatusUpdate'])->name('product.status');
     Route::post('/products/delete', [ProductController::class, 'Delete'])->name('product.delete');
     Route::get('/products/category/{category}', [ProductController::class, 'GetProducts'])->name('product.category');


    // Color All Routes
    Route::resource('units', UnitController::class);
    Route::post('/units/status', [UnitController::class, 'StatusUpdate'])->name('unit.status');
    Route::post('/units/delete', [UnitController::class, 'Delete'])->name('unit.delete');

    // Customer All Routes
    Route::resource('customers', CustomerController::class);
    Route::post('/customers/status', [CustomerController::class, 'StatusUpdate'])->name('customer.status');
    Route::post('/customers/delete', [CustomerController::class, 'Delete'])->name('customer.delete');
    Route::get('/customers/payment/{customer}', [PaymentController::class, 'Addpayment'])->name('payment.add');
    Route::post('/customers/payment/{customer}', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/customers/payment/show/{customer}', [PaymentController::class, 'show'])->name('payment.show');
    Route::get('/customers/bills/show/{customer}', [BillingController::class, 'showbills'])->name('billing.all');
    Route::get('/payment/edit/{billing}/{id}', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::patch('/payment/update/{billing}', [PaymentController::class, 'update'])->name('payment.update');
    Route::post('/payment/delete', [PaymentController::class, 'Delete'])->name('payment.delete.one');
  

    // SMTP and Site Setting  All Route
    Route::controller(SettingController::class)->group(function () {
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::patch('/update/site/setting/{id}', 'UpdateSiteSetting')->name('update.site.setting');

    });
    Route::controller(BillingController::class)->group(function () {
        Route::get('/billing', 'index')->name('billing.index');
        Route::post('/cart', 'cart')->name('cart.submit');
        Route::get('/cart/{id}', 'getCart')->name('get.cart');
        Route::get('/billing/show', 'showbilling')->name('billing.show');
        Route::post('/billing/delete',  'Delete')->name('billing.delete');
        Route::post('/billing_payment_details/{customer}', 'showBillingPayments')->name('billing.payments');
        Route::get('/billing_ledger/{customer}', 'Billingledger')->name('billing.ledger');
       // Route::patch('/update/site/setting/{id}', 'UpdateSiteSetting')->name('update.site.setting');

    });

    Route::controller(UserController::class)->group(function () {
        // User All Routes
        Route::get('/users', 'AllUsers')->name('admin.users');
        Route::get('/users/add', 'UserAdd')->name('admin.user_add');
        Route::post('/users/store', 'UserStore')->name('admin.user_store');
        Route::get('/users/edit/{id}', 'UserEdit')->name('admin.user_edit');
        Route::put('/users/update', 'UserUpdate')->name('admin.user_update');
        Route::put('/users/status', 'UserStatusUpdate')->name('admin.user_status');
        Route::delete('/users/delete/{id}', 'UserDelete')->name('admin.user_delete');
    });
});

// Admin Group Middleware
Route::middleware(['auth', 'roles:admin'])->prefix('admin')->group(function () {

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
// End Group Admin Middleware
