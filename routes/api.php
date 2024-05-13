<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::group(['prefix' => 'auth'], function(){
    Route::post('register', [AuthController::class, 'register']);
});