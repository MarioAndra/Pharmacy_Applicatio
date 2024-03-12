<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::prefix('v1/')->group(function () {

Route::post('status/{id}',[AdminController::class,'acceptOrReject']);

})->middleware('admin');
