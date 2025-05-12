<?php

use App\Http\Controllers\Auth\AuthWebController;
use App\Http\Controllers\Pendaftaran\PendaftaranWebController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return view('login');
})->name('web/login');

Route::post('/login', [AuthWebController::class, 'login'])->name('login');
Route::post('/logout', [AuthWebController::class, 'logout'])->name('auth.logout');

Route::middleware(['web', 'auth:web'])->prefix("admin")->group(function () {
    Route::get("dashboard", function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');

    Route::resource('pendaftaran', PendaftaranWebController::class);
    Route::post('verifikasi/pendaftaran/{id}', [PendaftaranWebController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
});
