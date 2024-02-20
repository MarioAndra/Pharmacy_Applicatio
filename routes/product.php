<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

    Route::post('create_Product',[ProductController::class,'createProduct']);
    Route::delete('delete_product/{id}',[ProductController::class,'deleteProduct']);
    Route::post('update_product/{id}',[ProductController::class,'updateProduct']);
    Route::get('show_product',[ProductController::class,'showProduct']);
