<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::post('login',[AdminController::class,'login']);
