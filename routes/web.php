<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ProductCategoryController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/articles', function () {
    return view('articles');
})->name('articles');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/get-product', [ProductController::class, 'getProduct']);

Route::get('/partnership', function () {
    return view('partnership');
})->name('partnership');

// Route::get('/admin', function () {
//     return view('admin');
// })->name('admin');

Route::get('/login', function () {
    return view('login');
})->name('login');

// === ADMIN === //
// PRODUCTS
Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin-products');
Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin-products.store');
Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin-products.update');
Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin-products.destroy');
// PRODUCTS CATEGORY
// Route::post('/admin/products', [ProductCategoryController::class, 'store'])->name('admin-product-categories.store');

// ARTICLES
// Route::get('/admin/articles', function () {
//     return view('admin-articles');
// })->name('admin-articles');
Route::controller(ArticleController::class)->group(function () {
    Route::get('/admin/articles', 'index')->name('admin-articles');
    Route::post('/admin/articles', 'store')->name('admin-articles.store');
    Route::delete('/admin/articles/{id}', 'destroy')->name('admin-articles.destroy');
    // Route::post('/orders', 'store');
});