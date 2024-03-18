<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;

Route::put('roles/{role}', [RoleController::class, 'update']);
