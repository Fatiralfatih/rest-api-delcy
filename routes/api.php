<?php

use App\Http\Controllers\api\GalleryController;
use App\Http\Controllers\api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/product', [ProductController::class, 'create'])->name('product.create');
Route::put('/product/{slug}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{slug}', [ProductController::class, 'delete'])->name('product.delete');

// gallery
Route::get('gallery/{id}', [GalleryController::class, 'index'])->name('gallery.index');