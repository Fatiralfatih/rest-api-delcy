<?php

use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\GalleryController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{slug}/show', [ProductController::class, 'show'])->name('product.show');
Route::post('/product/create', [ProductController::class, 'store'])->name('product.store');
Route::put('/product/{slug}/update', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{slug}/delete', [ProductController::class, 'delete'])->name('product.delete');

//category
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');

// gallery
Route::get('galleries/{productId}', [GalleryController::class, 'show'])->name('gallery.index');
Route::post('gallery/{slugProduct}/create', [GalleryController::class, 'store'])->name('gallery.store');
Route::put('gallery/{idGallery}/update', [GalleryController::class, 'update'])->name('gallery.update');
Route::delete('gallery/{idGallery}/delete', [GalleryController::class, 'delete'])->name('gallery.delete');