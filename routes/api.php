<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::group(['prefix' => 'auth'], function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum'], function(){

    Route::group(['prefix' => 'category'], function(){
        Route::post('store', [CategoryController::class, 'createCategory']);
        Route::get('list' , [CategoryController::class, 'list']);
        Route::get('edit/{category}', [CategoryController::class, 'editCategory']);
        Route::put('update/{category}', [CategoryController::class, 'updateCategory']);
        Route::delete('delete/{category}', [CategoryController::class, 'deleteCategory']);
    });

    Route::group(['prefix' => 'product'], function(){
        Route::post('store', [ProductController::class, 'createProduct']);
        Route::get('list' , [ProductController::class, 'list']);
        Route::get('edit/{product}', [ProductController::class, 'editProduct']);
        Route::put('update/{product}', [ProductController::class, 'updateProduct']);
        Route::delete('delete/{product}', [ProductController::class, 'deleteProduct']);
        
    });

});