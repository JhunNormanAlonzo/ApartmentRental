<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/rooms', \App\Http\Controllers\RoomController::class);
    Route::get('get-tenant-info', [\App\Http\Controllers\TenantController::class, 'getTenantInfo'])->name('tenants.get-tenant-info');
    Route::resource('/tenants', \App\Http\Controllers\TenantController::class);
    Route::resource('/ledgers', \App\Http\Controllers\LedgerController::class);
});
