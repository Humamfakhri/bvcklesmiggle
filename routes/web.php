<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminDownloadController;
use App\Http\Controllers\AdminPartnershipController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserController;

Route::get('/tes', function () {
    Artisan::call('storage:link');
    return "Storage Link have been run successfully!";
});

// AUTHENTICATION
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'loginForm'])->name('loginForm');
    Route::get('/register', [UserController::class, 'registerForm'])->name('registerForm');
    Route::post('/register', [UserController::class, 'register'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// HOME
Route::get('/', function () {
    // return view('waiting'); // The home page view
    return view('home');
})->name('home');

// ARTICLES
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
// Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles', [ArticleController::class, 'storeComment'])->name('articlesComment.store');
Route::get('/get-article', [ArticleController::class, 'getArticle']);

// PRODUCTS
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/get-product', [ProductController::class, 'getProduct']);

// PARTNERSHIP
Route::get('/partnership', [PartnershipController::class, 'index'])->name('partnership');
// Route::get('/partnership', function () {
//     return view('partnership');
// })->name('partnership');

Route::get('/waiting', function () {
    return view('waiting');
})->name('waiting');

// === ADMIN === //
Route::middleware('auth-admin')->group(function () {
    Route::get('/admin', [AuthController::class, 'index']);
    Route::post('/admin', [AuthController::class, 'login'])->name('login-admin');
});

Route::middleware('only-admin')->group(function () {
    Route::controller(AdminArticleController::class)->group(function () {
        Route::get('/admin/articles', 'index')->name('admin-articles');
        Route::post('/admin/articles', 'store')->name('admin-articles.store');
        Route::put('/admin/articles/{id}', 'update')->name('admin-articles.update');
        Route::delete('/admin/articles/{id}', 'destroy')->name('admin-articles.destroy');
    });
    Route::controller(AdminProductController::class)->group(function () {
        Route::get('/admin/products', 'index')->name('admin-products');
        Route::post('/admin/products', 'store')->name('admin-products.store');
        Route::put('/admin/products/{id}', 'update')->name('admin-products.update');
        Route::delete('/admin/products/{id}', 'destroy')->name('admin-products.destroy');
    });
    Route::controller(AdminPartnershipController::class)->group(function () {
        Route::get('/admin/partnership', 'index')->name('admin-partnerships');
        Route::post('/admin/partnership', 'store')->name('admin-partnerships.store');
        Route::put('/admin/partnership/{id}', 'update')->name('admin-partnerships.update');
        Route::delete('/admin/partnership/{id}', 'destroy')->name('admin-partnerships.destroy');
    });
    Route::controller(AdminDownloadController::class)->group(function () {
        Route::get('/admin/downloads', 'index')->name('admin-downloads');
        Route::post('/admin/downloads', 'store')->name('admin-downloads.store');
        Route::put('/admin/downloads/{id}', 'update')->name('admin-downloads.update');
        Route::delete('/admin/downloads/{id}', 'destroy')->name('admin-downloads.destroy');
    });
    Route::controller(AdminUserController::class)->group(function () {
        Route::get('/admin/users', 'index')->name('admin-users.index');
        Route::post('/admin/users', 'store')->name('admin-users.store');
        Route::delete('/admin/users/{id}', 'destroy')->name('admin-users.destroy');
    });
    Route::get('/logout-admin', [AuthController::class, 'logout'])->name('logout-admin');
});

