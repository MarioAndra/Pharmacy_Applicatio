<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::prefix('v1/')->group(function () {

Route::post('accept/{id}',[AdminController::class,'accept']);
Route::post('reject/{id}',[AdminController::class,'reject']);

})->middleware('admin');
