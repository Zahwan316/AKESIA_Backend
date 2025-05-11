<?php

use App\Http\Controllers\Auth\AuthWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return view('login');
})->name('index.login');

Route::post('/login', [AuthWebController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthWebController::class, 'logout'])->name('auth.logout');

Route::prefix("/admin")->middleware('auth:web')->group(function () {
    Route::get("/dashboard", function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});
