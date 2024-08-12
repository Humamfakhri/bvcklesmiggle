<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/articles', function () {
    return view('articles');
})->name('articles');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/partnership', function () {
    return view('partnership');
})->name('partnership');

// Route::get('/admin', function () {
//     return view('admin');
// })->name('admin');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/admin/articles', function () {
    return view('admin-articles');
})->name('admin-articles');

Route::get('/admin/products', function () {
    return view('admin-products');
})->name('admin-products');