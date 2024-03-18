<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;




Route::post('status/{id}',[AdminController::class,'acceptOrReject'])->middleware('owner');


