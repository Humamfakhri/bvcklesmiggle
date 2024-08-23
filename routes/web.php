<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminProductController;

// HOME
Route::get('/', function () {
    return view('home');
})->name('home');

// ARTICLES
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/get-article', [ArticleController::class, 'getArticle']);

// PRODUCTS
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/get-product', [ProductController::class, 'getProduct']);

// PARTNERSHIP
Route::get('/partnership', function () {
    return view('partnership');
})->name('partnership');


// === ADMIN === //
Route::get('/login', function () {
    return view('login');
})->name('login');

// PRODUCTS
Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin-products');
Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin-products.store');
Route::put('/admin/products/{id}', [AdminProductController::class, 'update'])->name('admin-products.update');
Route::delete('/admin/products/{id}', [AdminProductController::class, 'destroy'])->name('admin-products.destroy');
// PRODUCTS CATEGORY
// Route::post('/admin/products', [ProductCategoryController::class, 'store'])->name('admin-product-categories.store');

// ARTICLES
Route::controller(AdminArticleController::class)->group(function () {
    Route::get('/admin/articles', 'index')->name('admin-articles');
    Route::post('/admin/articles', 'store')->name('admin-articles.store');
    Route::put('/admin/articles/{id}', 'update')->name('admin-articles.update');
    Route::delete('/admin/articles/{id}', 'destroy')->name('admin-articles.destroy');
    // Route::post('/orders', 'store');
});