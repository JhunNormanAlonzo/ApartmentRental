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

    Route::put('/rooms/{room}/inclusions', [\App\Http\Controllers\RoomController::class, 'updateInclusions'])->name('rooms.updateInclusions');
    Route::resource('/rooms', \App\Http\Controllers\RoomController::class);
    Route::get('get-tenant-info', [\App\Http\Controllers\TenantController::class, 'getTenantInfo'])->name('tenants.get-tenant-info');
    Route::resource('/tenants', \App\Http\Controllers\TenantController::class);
    Route::get('/ledgers/get-tenant-payment-list/{tenant}', [\App\Http\Controllers\LedgerController::class, 'getTenantPaymentList'])->name('ledgers.getTenantPaymentList');
    Route::resource('/ledgers', \App\Http\Controllers\LedgerController::class);
    Route::resource('/inclusions', \App\Http\Controllers\InclusionController::class);
});
