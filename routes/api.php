<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UnitController;
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

    Route::group(['prefix' => 'unit'], function(){
        Route::post('store', [UnitController::class, 'createUnit']);
        Route::get('list' , [UnitController::class, 'list']);
        Route::get('edit/{unit}', [UnitController::class, 'editUnit']);
        Route::put('update/{unit}', [UnitController::class, 'updateUnit']);
        Route::delete('delete/{unit}', [UnitController::class, 'deleteUnit']);
    });

});