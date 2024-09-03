<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminProductController;



Route::middleware('checkLaunchDate')->group(function () {

    // HOME
    Route::get('/', function () {
        // // Define the launch date
        // $launchDate = Carbon::create(2024, 8, 29); // Example: September 15, 2024

        // // Check if the current date is before the launch date
        // if (now()->lt($launchDate)) {
        //     return view('waiting'); // The waiting page view
        // }

        return view('home'); // The home page view
    })->name('home');

    // ARTICLES
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
    // Route::post('/articles', [ArticleController::class, 'storeComment'])->name('articlesComment.store');
    Route::get('/get-article', [ArticleController::class, 'getArticle']);

    // PRODUCTS
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/get-product', [ProductController::class, 'getProduct']);

    // PARTNERSHIP
    Route::get('/partnership', function () {
        return view('partnership');
    })->name('partnership');


    // === ADMIN === //
    Route::middleware('auth')->group(function () {
        Route::get('/sipalingadminB$', [AuthController::class, 'index']);
        Route::post('/sipalingadminB$', [AuthController::class, 'login'])->name('login');
    });
    Route::middleware('admin')->group(function () {
        Route::controller(AdminArticleController::class)->group(function () {
            Route::get('/sipalingadminB$/articles', 'index')->name('admin-articles');
            Route::post('/sipalingadminB$/articles', 'store')->name('admin-articles.store');
            Route::put('/sipalingadminB$/articles/{id}', 'update')->name('admin-articles.update');
            Route::delete('/sipalingadminB$/articles/{id}', 'destroy')->name('admin-articles.destroy');
        });
        Route::get('/sipalingadminB$/products', [AdminProductController::class, 'index'])->name('admin-products');
        Route::post('/sipalingadminB$/products', [AdminProductController::class, 'store'])->name('admin-products.store');
        Route::put('/sipalingadminB$/products/{id}', [AdminProductController::class, 'update'])->name('admin-products.update');
        Route::delete('/sipalingadminB$/products/{id}', [AdminProductController::class, 'destroy'])->name('admin-products.destroy');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::get('/waiting', function () {
    return view('waiting'); // The waiting page view
})->name('waiting');