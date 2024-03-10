<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Models\User;





Route::group(['middleware' => 'auth:sanctum'], function () {

    include('Task/admin.php');
 });


 Route::prefix('v1/')->group(function () {

    include('Task/user.php');

    include('Task/category.php');

    include('Task/product.php');

    include('Task/auth.php');



});





