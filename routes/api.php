<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::get('/GetAllUsers', 'getAllUsers');
    Route::post('/SaveUser', 'saveUser');
});
Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {
	Route::get('/GetAllCategories', 'getCategories');
    Route::post('/SaveCategory', 'saveCategory');
});
Route::group(['prefix' => 'Products', 'controller' => ProductController::class], function () {
	Route::get('/GetAllProducts', 'getAllProducts');
    Route::post('/SaveProduct', 'saveProduct');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
