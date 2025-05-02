<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Ibu\IbuController;

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

Route::get("/", function () {
    return ["message" => "Hello World"];
});
