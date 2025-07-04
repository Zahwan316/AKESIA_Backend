<?php

use App\Http\Controllers\AlbumFoto\AlbumFotoController;
use App\Http\Controllers\AlbumFoto\AlbumFotoJaninController;
use App\Http\Controllers\AlbumFoto\AlbumFotoUsgController;
use App\Http\Controllers\Form\KesimpulanIbuNifas;
use App\Http\Controllers\Form\PelayananIbuBersalinController;
use App\Http\Controllers\Form\PelayananIbuNifasController;
use App\Http\Controllers\Form\PemeriksaanUmum;
use App\Http\Controllers\Form\RiwayatKehamilanSekarangController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Pemeriksaan\PemeriksaanController;
use App\Http\Controllers\RiwayatKehamilan\RiwayatKehamilanFotoController;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Banner\BannerController;
use App\Http\Controllers\Bayi\BayiController;
use App\Http\Controllers\Bidan\BidanController;
use App\Http\Controllers\Fcm\FcmNotificationController;
use App\Http\Controllers\Form\BayiSaatLahirController;
use App\Http\Controllers\Form\FormLayananIbuLainnyaController;
use App\Http\Controllers\Form\PelayananBayiController;
use App\Http\Controllers\Form\PemeriksaanLab;
use App\Http\Controllers\Form\PengawasanMinumTabletController;
use App\Http\Controllers\Form\RiwayatKehamilanSebelumnyaController;
use App\Http\Controllers\Ibu\IbuController;
use App\Http\Controllers\Layanan\JenisPelayananController;
use App\Http\Controllers\Layanan\PelayananController;
use App\Http\Controllers\Layanan\PelayananFormItemController;
use App\Http\Controllers\Layanan\TambahanLayananController;
use App\Http\Controllers\Pendaftaran\PendaftaranController;
use App\Http\Controllers\Ref\ReferensiController;
use App\Http\Controllers\RiwayatKehamilan\RiwayatKehamilanGroupController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Auth
Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/checkiscompleteprofile', [AuthController::class,'checkIsCompleteProfile']);
Route::middleware('auth:api')->get('/checktoken', [AuthController::class,'checkToken']);
// routes/api.php
Route::middleware('auth:api')->post('/fcm-token', [FcmNotificationController::class, 'saveFcmToken']);
Route::post('/auth/google', [AuthController::class, 'googleLogin']);


//Ibu
Route::prefix('ibu')->middleware('auth:api')->group( function (){
    Route::Post('lengkapidata', [IbuController::class,'LengkapiData']);
    Route::Get('getdataibu/{user_id}', [IbuController::class,'GetDataIbu']);
    Route::Get('getalldataibu', [IbuController::class,'GetAllDataIbu']);
    Route::put('update/{id}', [IbuController::class,'UpdateData']);
    Route::get('getCurrIbu', [IbuController::class,'GetCurrIbu']);
});

//User
Route::middleware('auth:api')->resource('bidan', BidanController::class);
Route::middleware('auth:api')->get('getCurrBidan', [BidanController::class, 'getCurrBidan']);
Route::middleware('auth:api')->resource('pendaftaran', PendaftaranController::class);
Route::middleware('auth:api')->get('getCurrUserPendaftaran', [PendaftaranController::class, 'getCurrUserPendaftaran']);
Route::middleware('auth:api')->resource('bayi', BayiController::class);

//bayi
Route::middleware('auth:api')->get('/getUserAnak', [BayiController::class,'getAnak']);

//pemeriksaan
Route::middleware('auth:api')->resource('pemeriksaan', PemeriksaanController::class);

//banner
Route::middleware('auth:api')->resource('banner', BannerController::class);

//album foto
Route::middleware('auth:api')->resource('album_foto_janin', AlbumFotoJaninController::class);
Route::middleware('auth:api')->get('album_foto_janins/getByUserId/', [AlbumFotoJaninController::class, 'getItemByUserId']);
Route::middleware('auth:api')->resource('album_foto', AlbumFotoController::class);
Route::middleware('auth:api')->get('album_foto/getByUsgId/{id}', [AlbumFotoController::class, 'getItemByUsgId']);
Route::middleware('auth:api')->resource('album_foto_usg', AlbumFotoUsgController::class);
Route::middleware('auth:api')->get('album_foto_usg/getByJaninId/{id}', [AlbumFotoUsgController::class, 'getItemByJaninId']);

//riwayat kehamilan foto
Route::middleware('auth:api')->resource('riwayat_kehamilan_foto', RiwayatKehamilanFotoController::class);
Route::middleware('auth:api')->get('riwayat_kehamilan_foto/getByGroupId/{id}', [RiwayatKehamilanFotoController::class, 'getByGroupId']);
Route::middleware('auth:api')->resource('riwayat_kehamilan_group', RiwayatKehamilanGroupController::class);
Route::middleware('auth:api')->get('riwayat_kehamilan_groups/getByUserId', [RiwayatKehamilanGroupController::class, 'getByUserId']);


//Layanan
route::prefix('layanan')->middleware('auth:api')->group( function () {
    Route::resource('jenis_pelayanan', JenisPelayananController::class);
    Route::resource('pelayanan', PelayananController::class);
    Route::resource('pelayanan_form_item', PelayananFormItemController::class);
    Route::resource('tambahan_layanan', TambahanLayananController::class);
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
    Route::resource('layanan_ibu_lainnya', FormLayananIbuLainnyaController::class);
    Route::resource('bayi_saat_lahir', BayiSaatLahirController::class);
    Route::resource('riwayat_kehamilan_sebelumnya', RiwayatKehamilanSebelumnyaController::class);
    Route::resource('riwayat_kehamilan_sekarang', RiwayatKehamilanSekarangController::class);
    Route::Get('pelayanan_bayi/show_by_pendaftaran/{id}', [PelayananBayiController::class, 'showFormByPendaftaran']);
    Route::Get('pemeriksaan_umum/show_by_pendaftaran/{id}', [PemeriksaanUmum::class, 'showFormByPendaftaran']);
    Route::Get('pemeriksaan_lab/show_by_pendaftaran/{id}', [PemeriksaanLab::class, 'showFormByPendaftaran']);
    Route::Get('pengawasan_tablet/show_by_pendaftaran/{id}', [PengawasanMinumTabletController::class, 'showFormByPendaftaran']);
    Route::Get('pelayanan_ibu_bersalin/show_by_pendaftaran/{id}', [PelayananIbuBersalinController::class, 'showFormByPendaftaran']);
    Route::Get('bayi_saat_lahir/show_by_pendaftaran/{id}', [BayiSaatLahirController::class, 'showFormByPendaftaran']);
    Route::Get('pelayanan_ibu_nifas/show_by_pendaftaran/{id}', [PelayananIbuNifasController::class, 'showFormByPendaftaran']);
    Route::Get('kesimpulan_ibu_nifas/show_by_pendaftaran/{id}', [KesimpulanIbuNifas::class, 'showFormByPendaftaran']);
    Route::Get('layanan_ibu_lainnya/show_by_pendaftaran/{id}', [FormLayananIbuLainnyaController::class, 'showFormByPendaftaran']);
    Route::Get('riwayat_kehamilan_sebelumnya/show_by_pendaftaran/{id}', [RiwayatKehamilanSebelumnyaController::class, 'showFormByPendaftaran']);
    Route::Get('riwayat_kehamilan_sekarang/show_by_pendaftaran/{id}', [RiwayatKehamilanSekarangController::class, 'showFormByPendaftaran']);
});

//notification
route::middleware('auth:api')->resource('notification', NotificationController::class);

Route::get("/", function () {
    return ["message" => "Hello World"];
});
