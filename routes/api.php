<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\LaborController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\PasswordResetController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// public route
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/send-reset-password-email', [PasswordResetController::class, 'send_reset_password_email']);

// protected route
Route::group(['middleware' => ['auth:sanctum']], function (){

    Route::get('/user/{id}', [FieldController::class, 'userFieldCrop']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/logged', [AuthController::class, 'logged_user']);
    Route::post('/changepassword', [AuthController::class, 'change_password']);
    Route::resource('/fields',FieldController::class);
    Route::resource('/products',ProductController::class);
    Route::resource('/crops',CropController::class);
    Route::resource('/costs',CostController::class);
    Route::resource('/equipments',EquipmentController::class);
    Route::resource('/labors',LaborController::class);
    
});