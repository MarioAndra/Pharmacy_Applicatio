<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


    Route::post('create_category',[CategoryController::class,'createCategory']);
    Route::get('show_product_in_category/{id}',[CategoryController::class,'ShowProductInCategory']);
    Route::get('Show_get_category',[CategoryController::class,'showCategory']);
    Route::delete('delete_category/{id}',[CategoryController::class,'deletCategory']);
    Route::post('update_category/{id}',[CategoryController::class,'updateCategory']);
