<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::group(['middleware'=>'auth'], function(){

    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    //Route Karyawan
    Route::prefix('karyawan')->group(function(){
        Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/getData', [KaryawanController::class, 'getData'])->name('karyawan.getData');
        Route::get('/create', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('/', [KaryawanController::class, 'store'])->name('karyawan.store');
        Route::get('/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::patch('/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::get('/{id}', [KaryawanController::class, 'show'])->name('karyawan.show');
        Route::get('/{id}/detail', [KaryawanController::class, 'getDetail'])->name('karyawan.detail');
    });
});
