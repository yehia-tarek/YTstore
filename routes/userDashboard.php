<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Fronted\Dashboard\HomeController;
use App\Http\Controllers\Fronted\Dashboard\OrderController;
use App\Http\Controllers\Fronted\Dashboard\ProfileController;
use App\Http\Controllers\Fronted\Dashboard\PostCommentController;
use App\Http\Controllers\Fronted\Dashboard\ProductReviewController;



Route::get('/', [HomeController::class, 'index'])->name('user');

// Password Change
Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');


// Profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('user-profile');
Route::post('/profile/{id}', [ProfileController::class, 'profileUpdate'])->name('user-profile-update');

//  Order
Route::get('/order', [OrderController::class, 'index'])->name('user.order.index');
Route::get('/order/show/{id}', [OrderController::class, 'show'])->name('user.order.show');
Route::delete('/order/delete/{id}', [OrderController::class, 'delete'])->name('user.order.delete');

// Product Review
Route::get('/user-review', [ProductReviewController::class, 'index'])->name('user.productreview.index');
Route::delete('/user-review/delete/{id}', [ProductReviewController::class, 'delete'])->name('user.productreview.delete');
Route::get('/user-review/edit/{id}', [ProductReviewController::class, 'edit'])->name('user.productreview.edit');
Route::patch('/user-review/update/{id}', [ProductReviewController::class, 'update'])->name('user.productreview.update');

// Post comment
Route::get('user-post/comment', [PostCommentController::class, 'index'])->name('user.post-comment.index');
Route::delete('user-post/comment/delete/{id}', [PostCommentController::class, 'delete'])->name('user.post-comment.delete');
Route::get('user-post/comment/edit/{id}', [PostCommentController::class, 'edit'])->name('user.post-comment.edit');
Route::patch('user-post/comment/udpate/{id}', [PostCommentController::class, 'update'])->name('user.post-comment.update');
