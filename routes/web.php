<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

// Home Route
Route::get('/', [CategoryController::class, 'showHomeWithCategories'])->name('home');
Route::get('home', [CategoryController::class, 'showHomeWithCategories'])->name('home');
// Category Routes
Route::group(['prefix' => 'Categoria', 'controller' => CategoryController::class], function () {
    Route::get('{category}', 'ShowCategoryProducts')->name('category.show');
});

// Product Route
Route::group(['prefix' => 'Product', 'controller' => ProductController::class], function () {
    Route::get('{product}', 'showProduct')->name('product.show');
});

// Cart Routes
Route::group(['prefix' => 'Cart', 'middleware' => 'auth', 'controller' => CartController::class], function () {
    Route::get('/', 'showCart')->name('cart.show');
});


// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('admin.users');
    })->name('admin');

    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');

    Route::get('/products', function () {
        return view('admin.products');
    })->name('admin.products');

    Route::get('/categories', function () {
        return view('admin.categories');
    })->name('admin.categories');
});


// Auth Routes
Route::get('/registro', function () {
    return view('auth.registro');
})->name('registro');
Auth::routes();
