<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\PostTagController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\PostCategoryController;

/**
 * --------------------------------------------------------------------------
 * Admin Routes
 * --------------------------------------------------------------------------
 * All route names are prefixed with 'admin.'.
 * All route has middleware 'admin', 'auth','web'.
 *
 **/


Route::get('/', [AdminController::class, 'index'])->name('admin');

// Password Change
Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form');
Route::post('change-password', [AdminController::class, 'changPasswordStore'])->name('change.password');

Route::get('/file-manager', function () {
    return view('backend.layouts.file-manager');
})->name('file-manager');

// Profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('admin-profile');
Route::post('/profile/{id}', [ProfileController::class, 'profileUpdate'])->name('profile-update');

// Settings
Route::get('settings', [SettingController::class, 'settings'])->name('settings');
Route::post('setting/update', [SettingController::class, 'settingsUpdate'])->name('settings.update');


Route::resources([
    'users' => UsersController::class,
    'banner' => BannerController::class,

    'product' => ProductController::class,
    'category' => CategoryController::class,
    'brand' => BrandController::class,
    'shipping' => ShippingController::class,
    'order' => OrderController::class,
    'coupon' => CouponController::class,

    'post' => PostController::class,
    'post-category' => PostCategoryController::class,
    'post-tag' => PostTagController::class,

    'message' => MessageController::class,
]);

// Ajax for sub category
Route::post('/category/{id}/child', [CategoryController::class, 'getChildByParent']);

Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');

// Notification
Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');


