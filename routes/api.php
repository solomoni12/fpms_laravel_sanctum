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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// public route
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// protected route
Route::group(['middleware' => ['auth:sanctum']], function (){

    Route::get('/user/{id}', [FieldController::class, 'userFieldCrop']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/fields',FieldController::class);
    Route::resource('/products',ProductController::class);
    Route::resource('/crops',CropController::class);
    Route::resource('/costs',CostController::class);
    Route::resource('/equipments',EquipmentController::class);
    Route::resource('/labors',LaborController::class);
    
});