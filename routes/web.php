<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KalenderController;
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
        Route::post('/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::post('/{id}/email', [KaryawanController::class, 'changeemail'])->name('karyawan.changeemail');
        Route::get('/{id}', [KaryawanController::class, 'show'])->name('karyawan.show');
        Route::get('/{id}/detail', [KaryawanController::class, 'getDetail'])->name('karyawan.detail');
    });
    Route::get('/logout', [AuthController::class, 'logout'])->name('signout');

    //Route Jabatans
    Route::prefix('jabatan')->group(function(){
        Route::get('/', [JabatanController::class, 'index'])->name('jabatan.index');
        Route::get('/getData', [JabatanController::class, 'getData'])->name('jabatan.getData');
        Route::post('/', [JabatanController::class, 'store'])->name('jabatan.store');
        Route::get('/{id}', [JabatanController::class, 'show'])->name('jabatan.show');
        Route::post('/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
    });
    //Route Kalenders
    Route::prefix('kalender')->group(function(){
        Route::get('/', [KalenderController::class, 'index'])->name('kalender.index');
        Route::get('/getData', [KalenderController::class, 'getData'])->name('kalender.getData');
        Route::post('/', [KalenderController::class, 'store'])->name('kalender.store');
        Route::get('/{id}', [KalenderController::class, 'show'])->name('kalender.show');
        Route::post('/{id}', [KalenderController::class, 'update'])->name('kalender.update');
        Route::post('/{id}/default', [KalenderController::class, 'defaultkalender'])->name('kalender.default');
    });
});
