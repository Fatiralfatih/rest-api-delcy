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
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::put('/product/{slug}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{slug}', [ProductController::class, 'delete'])->name('product.delete');

//category
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');

// gallery
Route::get('galleries/{id}', [GalleryController::class, 'index'])->name('gallery.index');