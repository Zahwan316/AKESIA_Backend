<?php

use App\Http\Controllers\Form\KesimpulanIbuNifas;
use App\Http\Controllers\Form\PelayananIbuBersalinController;
use App\Http\Controllers\Form\PelayananIbuNifasController;
use App\Http\Controllers\Form\PemeriksaanUmum;
use App\Http\Controllers\Form\RiwayatKehamilanSekarangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Bayi\BayiController;
use App\Http\Controllers\Bidan\BidanController;
use App\Http\Controllers\Form\BayiSaatLahirController;
use App\Http\Controllers\Form\PelayananBayiController;
use App\Http\Controllers\Form\PemeriksaanLab;
use App\Http\Controllers\Form\PengawasanMinumTabletController;
use App\Http\Controllers\Form\RiwayatKehamilanSebelumnyaController;
use App\Http\Controllers\Ibu\IbuController;
use App\Http\Controllers\Layanan\JenisPelayananController;
use App\Http\Controllers\Layanan\PelayananController;
use App\Http\Controllers\Pendaftaran\PendaftaranController;
use App\Http\Controllers\Ref\ReferensiController;
use App\Models\Form_pemeriksaan_umum;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth
Route::post('/login', [AuthController::class,'login']);
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

//bayi
Route::middleware('auth:api')->get('/getUserAnak', [BayiController::class,'getAnak']);


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
    Route::get('/kesadaran', [ReferensiController::class,'showKesadaran']);
    Route::get('/provinsi', [ReferensiController::class,'showProvinsi']);
    Route::get('/jenis_praktik', [ReferensiController::class,'showJenisPraktik']);
});

//form
Route::prefix('form')->middleware('auth:api')->group(function(){
    Route::resource('pemeriksaan_umum', PemeriksaanUmum::class);
    Route::resource('pemeriksaan_lab', PemeriksaanLab::class);
    Route::resource('pengawasan_tablet', PengawasanMinumTabletController::class);
    Route::resource('pelayanan_bayi', PelayananBayiController::class);
    Route::resource('pelayanan_ibu_nifas', PelayananIbuNifasController::class);
    Route::resource('kesimpulan_ibu_nifas', KesimpulanIbuNifas::class);
    Route::resource('pelayanan_ibu_bersalin', PelayananIbuBersalinController::class);
    Route::resource('bayi_saat_lahir', BayiSaatLahirController::class);
    Route::resource('riwayat_kehamilan_sebelumnya', RiwayatKehamilanSebelumnyaController::class);
    Route::resource('riwayat_kehamilan_sekarang', RiwayatKehamilanSekarangController::class);
});

Route::get("/", function () {
    return ["message" => "Hello World"];
});
