<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use App\Models\Medicin;

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



Route::group(['middleware' => 'auth:sanctum'], function () {
 });

 Route::prefix('v1/')->group(function () {

    Route::post('create',[UserController::class,'createUser']);
    Route::post('Update_user/{id}',[UserController::class,'updatUser']);
    Route::get('Users',[UserController::class,'showUser']);
    Route::delete('deleteUsers/{id}',[UserController::class,'deleteUser']);


    Route::post('create_Product',[ProductController::class,'createProduct']);
    Route::delete('delete_product/{id}',[ProductController::class,'deleteProduct']);
    Route::post('update_product/{id}',[ProductController::class,'updateProduct']);
    Route::get('show_product',[ProductController::class,'showProduct']);


    Route::post('create_category',[CategoryController::class,'createCategory']);
    Route::get('show_product_in_category/{id}',[CategoryController::class,'ShowProductInCategory']);
    Route::get('Show_get_category',[CategoryController::class,'showCategory']);
    Route::delete('delete_category/{id}',[CategoryController::class,'deletCategory']);
    Route::post('update_category/{id}',[CategoryController::class,'updateCategory']);

});

