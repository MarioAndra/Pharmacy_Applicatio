
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Task\AdminController;




Route::apiResource('users', UserController::class);

Route::put('Password/{id}',[UserController::class,'updatePassword']);







