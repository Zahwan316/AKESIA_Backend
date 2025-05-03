<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Bayi\BayiController;
use App\Http\Controllers\Bidan\BidanController;
use App\Http\Controllers\Ibu\IbuController;
use App\Http\Controllers\Layanan\JenisPelayananController;
use App\Http\Controllers\Layanan\PelayananController;
use App\Http\Controllers\Pendaftaran\PendaftaranController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');

Route::prefix('ibu')->middleware('auth:api')->group( function (){
    Route::Post('/lengkapidata', [IbuController::class,'LengkapiData']);
    Route::Get('/getdataibu/{user_id}', [IbuController::class,'GetDataIbu']);
    Route::Get('/getalldataibu', [IbuController::class,'GetAllDataIbu']);
});

Route::middleware('auth:api')->resource('bidan', BidanController::class);
Route::middleware('auth:api')->resource('pendaftaran', PendaftaranController::class);
Route::middleware('auth:api')->resource('bayi', BayiController::class);

route::prefix('layanan')->middleware('auth:api')->group( function () {
    Route::resource('jenis_pelayanan', JenisPelayananController::class);
    Route::resource('pelayanan', PelayananController::class);
});

Route::get("/", function () {
    return ["message" => "Hello World"];
});
