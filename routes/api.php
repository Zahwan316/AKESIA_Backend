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
use App\Http\Controllers\Ref\ReferensiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/checkiscompleteprofile', [AuthController::class,'checkIsCompleteProfile']);
Route::middleware('auth:api')->get('/checktoken', [AuthController::class,'checkToken']);

//Ibu
Route::prefix('ibu')->middleware('auth:api')->group( function (){
    Route::Post('/lengkapidata', [IbuController::class,'LengkapiData']);
    Route::Get('/getdataibu/{user_id}', [IbuController::class,'GetDataIbu']);
    Route::Get('/getalldataibu', [IbuController::class,'GetAllDataIbu']);
});

//User
Route::middleware('auth:api')->resource('bidan', BidanController::class);
Route::middleware('auth:api')->resource('pendaftaran', PendaftaranController::class);
Route::middleware('auth:api')->get('getCurrUserPendaftaran', [PendaftaranController::class, 'getCurrUserPendaftaran']);
Route::middleware('auth:api')->resource('bayi', BayiController::class);

//Layanan
route::prefix('layanan')->middleware('auth:api')->group( function () {
    Route::resource('jenis_pelayanan', JenisPelayananController::class);
    Route::resource('pelayanan', PelayananController::class);
});

//Referensi
Route::prefix('referensi')->middleware('auth:api')->group( function () {
    Route::get('/pendidikan', [ReferensiController::class,'showPendidikan']);
    Route::get('/pekerjaan', [ReferensiController::class,'showPekerjaan']);
    Route::get('/kota', [ReferensiController::class,'showKota']);
    Route::get('/provinsi', [ReferensiController::class,'showProvinsi']);
});

Route::get("/", function () {
    return ["message" => "Hello World"];
});
