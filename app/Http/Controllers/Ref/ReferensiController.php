<?php

namespace App\Http\Controllers\Ref;

use App\Http\Controllers\Controller;
use App\Models\Ref_Kota;
use App\Models\Ref_Pekerjaan;
use App\Models\Ref_Pendidikan;
use App\Models\Ref_Provinsi;
use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    //
    public function showPendidikan(){
        $data = Ref_Pendidikan::all();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }

    public function showPekerjaan(){
        $data = Ref_Pekerjaan::all();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }

    public function showKota(){
        $data = Ref_Kota::all();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }

    public function showProvinsi(){
        $data = Ref_Provinsi::all();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }
}
