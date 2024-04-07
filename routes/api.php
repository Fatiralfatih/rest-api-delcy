<?php

use App\Http\Controllers\api\AuthenticatedController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\GalleryController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Support\Facades\Route;

// authenticated
Route::post('user/register', [AuthenticatedController::class, 'register'])->name('user.regsiter');
Route::post('/user/login', [AuthenticatedController::class, 'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function () {
    // logout
    Route::post('/logout', [AuthenticatedController::class, 'logout'])->name('user.logout');

    // products
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/{slug}/show', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
    Route::put('/product/{slug}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{slug}/delete', [ProductController::class, 'delete'])->name('product.delete');

    // category
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{nameCategory}/show', [CategoryController::class, 'show'])->name('category.show');

    // gallery
    Route::get('galleries/{productId}', [GalleryController::class, 'show'])->name('gallery.index');
    Route::post('gallery/{slugProduct}/create', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('gallery/{idGallery}/update', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('gallery/{idGallery}/delete', [GalleryController::class, 'delete'])->name('gallery.delete');
});