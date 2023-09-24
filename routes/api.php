<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Auth Routes
Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
});

//Category Routes
Route::group([], function() {

        Route::get('category' , [CategoryController::class , 'index']);
        Route::post('category' , [CategoryController::class , 'store']);
        Route::post('category/{id}' , [CategoryController::class , 'update']);
        Route::delete('category/{id}' , [CategoryController::class , 'destroy']);

});
