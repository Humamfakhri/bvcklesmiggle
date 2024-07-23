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
