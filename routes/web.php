<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Spatie\Permission\Models\Role; // import the Role model class

Route::get('/test', function () {
    $users = User::get();
    foreach ($users as $user) {
        if ($user->username == 'jeffmontoya'){
            $user->assignRole('admin');
        }else{
            $user->assignRole('user');
        }
    }
});

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
    Route::get('/GetUserCart', 'getUserCart');
    Route::delete('/DeleteCart/{cart}', 'deleteCart');
    Route::get('/GetCart/{cart}', 'getCart');
});


// User Routes
Route::group(['prefix' => 'User', 'controller' => UserController::class], function () {
    Route::get('/GetAllUsers', 'getAllUsers');
    Route::post('/SaveUser', 'saveUser');
    Route::put('/UpdateUser', 'updateUser');
    Route::delete('/DeleteUser', 'deleteUser');
    Route::post('/NewUser', 'newUser')->name('newUser');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth','role:admin']], function () {
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
Route::middleware('auth')->post('/cart', [CartController::class, 'store'])->name('cart.store');
