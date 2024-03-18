<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\RoleController;
use App\Models\User;




include('Task/auth.php');

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::prefix('v1/')->group(function () {

    include('Task/owner.php');
    include('Task/user.php');
    include('Task/product.php');
    include('Task/category.php');
    include('Task/role.php');
    });

});







