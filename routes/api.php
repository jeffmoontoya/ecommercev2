<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::get('/GetAllUsers', 'getAllUsers');
    Route::get('GetAnUser/{user}', 'getAnUser');
    Route::post('/SaveUser', 'saveUser');
    Route::put('/UpdateUser/{user}', 'updateUser');
    Route::delete('/DeleteUser/{user}', 'deleteUser');
});
Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {
	Route::get('/GetAllCategories', 'getCategories');
    Route::get('/GetCategory/{category}', 'getCategory');
    Route::post('/SaveCategory', 'saveCategory');
    Route::put('/UpdateCategory/{category}', 'updateCategory');
    Route::delete('/DeleteCategory/{category}', 'deleteCategory');
});

Route::group(['prefix' => 'Products', 'controller' => ProductController::class], function () {
	Route::get('/GetAllProducts', 'getAllProducts');
    Route::get('/GetAProduct/{product}', 'getAProduct');
    Route::post('/SaveProduct', 'saveProduct');
    Route::post('/UpdateProduct/{product}', 'updateProduct');
    Route::delete('/DeleteProduct/{product}', 'deleteProduct');
});

Route::group(['prefix' => 'Cart', 'middleware' => 'auth', 'controller' => CartController::class], function () {
    Route::get('/GetUserCart', 'getUserCart');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
