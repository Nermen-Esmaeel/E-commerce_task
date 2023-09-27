<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ProductController;
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


Route::middleware(['auth'])->group(function () {

        //Category Routes
        Route::get('categories' , [CategoryController::class , 'index']);
        Route::post('categories' , [CategoryController::class , 'store']);
        Route::post('categories/{id}' , [CategoryController::class , 'update']);
        Route::delete('categories/{id}' , [CategoryController::class , 'destroy']);

        //Product Routes
        Route::get('products' , [ProductController::class , 'index']);
        Route::post('products' , [ProductController::class , 'store']);
        Route::post('products/{id}' , [ProductController::class , 'update']);
        Route::delete('products/{id}' , [ProductController::class , 'destroy']);

        //cart Routes
        Route::get('carts' , [CartController::class , 'index']);
        Route::post('carts' , [CartController::class , 'store']);
        Route::post('carts/{cart}' , [CartController::class , 'update']);
        Route::delete('carts/{cart}' , [CartController::class , 'destroy']);

});
