<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AbsenController;
use App\Http\Controllers\API\AjuanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('updateprofile',[AuthController::class, 'updateprofile']);
    Route::post('updateaccount', [AuthController::class, 'changeemail']);
    Route::get('getdata', [AuthController::class, 'fetchdata']);
    Route::get('getizinuser', [AjuanController::class, 'getizinuser']);
    Route::get('getdinasluar', [AjuanController::class, 'getdinasluar']);
    Route::post('ajukanizinsakit', [AjuanController::class, 'ajukanizinsakit']);
    Route::post('ajukandinasluar', [AjuanController::class, 'ajukandinasluar']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('absenmasuk', [AbsenController::class, 'absenmasuk']);
    Route::post('absenkeluar', [AbsenController::class, 'absenkeluar']);
    Route::get('getdetailizinsakit', [AjuanController::class,'getdetailizinsakit']);
    Route::post('changepassword', [AuthController::class, 'changepassword']);
    Route::get('getlistabsentoday', [AbsenController::class, 'getlistabsentoday']);
    Route::get('getcalender', [AbsenController::class, 'getcalender']);
    Route::post('cancelajuan', [AjuanController::class, 'cancelajuan']);
});
