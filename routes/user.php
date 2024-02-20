
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::post('create',[UserController::class,'createUser']);
Route::post('Update_user/{id}',[UserController::class,'updatUser']);
Route::post('update_User_Password/{id}',[UserController::class,'updateUserPassword']);

Route::get('Users',[UserController::class,'showUser']);
Route::get('show_product_user/{id}',[UserController::class,'showProductUser']);
Route::delete('deleteUsers/{id}',[UserController::class,'deleteUser']);


