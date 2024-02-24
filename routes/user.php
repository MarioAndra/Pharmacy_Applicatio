
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\updatePhotoController;
use App\Models\User;




Route::apiResource('user', UserController::class);

Route::put('update/User/Password/{id}',[UserController::class,'updatePassword']);







