<?php

use App\Http\Controllers\Auth\AuthWebController;
use App\Http\Controllers\Banner\BannerWebController;
use App\Http\Controllers\Bidan\BidanWebController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\DataDeletionController;
use App\Http\Controllers\Laporan\LaporanWebController;
use App\Http\Controllers\Layanan\ImportLayananWebController;
use App\Http\Controllers\Layanan\JenisPelayananWebController;
use App\Http\Controllers\Layanan\PelayananWebController;
use App\Http\Controllers\Pendaftaran\PendaftaranWebController;
use App\Models\Jenis_layanan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function() {
    return view('login');
})->name('web/login');

Route::post('/login', [AuthWebController::class, 'login'])->name('login');
Route::post('/logout', [AuthWebController::class, 'logout'])->name('web.logout')->middleware('auth:web');

Route::get('/privacy', function(){
    return view('privacy');
})->name('privacy');

Route::get('/data-deletion', function(){
    return view('deletion');
})->name('deletion.form');

Route::post('/data-deletion', [DataDeletionController::class, 'submitRequest'])->name('data-deletion.submit');
Route::get('/data-deletion/verify/{token}', [DataDeletionController::class, 'verifyRequest'])->name('data-deletion.verify');
Route::post('/data-deletion/process', [DataDeletionController::class, 'processDeletion'])->name('data-deletion.process');

Route::middleware(['web', 'auth:web'])->prefix("admin")->group(function () {
    Route::get("dashboard", [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('pendaftaran', PendaftaranWebController::class);
    Route::put('verifikasi/pendaftaran/{id}', [PendaftaranWebController::class, 'verifikasi'])->name('pendaftaran.verifikasi');

    Route::resource('laporan', LaporanWebController::class);
    Route::resource('bidan', BidanWebController::class);
    Route::resource('jenis_layanan', JenisPelayananWebController::class);
    Route::resource('layanan', PelayananWebController::class);
    Route::resource('banner', BannerWebController::class);

    Route::get('/import/layanan', [ImportLayananWebController::class, 'importForm'])->name('layanan.import.form');
    Route::post('/import/layanan', [ImportLayananWebController::class, 'import'])->name('layanan.import');

});


