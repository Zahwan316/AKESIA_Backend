<?php

namespace App\Http\Controllers\Ibu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ibu;

class IbuController extends Controller
{
    public function GetDataIbu(string $user_id){
        $data = Ibu::where("user_id",$user_id)->get();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }

    public function GetAllDataIbu(){
        $data = Ibu::all();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }

    //
    public function LengkapiData(Request $request){
        $validate = $request->validate([
            'nik' => 'required|unique:ibus|integer',
            'golongan_darah' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'alamat_domisili' => 'required',
            'telepon' => 'required|unique:ibus',
            'user_id' => 'required',
            'berat_badan' => 'nullable',
            'tinggi_badan' => 'nullable',
            'usia_kehamilan' => 'nullable'
        ]);

    try{

        $data = $request->only([
            'nik', 'golongan_darah', 'tempat_lahir', 'tanggal_lahir',
            'pendidikan', 'pekerjaan', 'alamat_domisili', 'telepon', 'user_id',
            'berat_badan', 'tinggi_badan', 'usia_kehamilan'
        ]);
        Ibu::create($data);
        return response()->json(['message' => 'Data berhasil disimpan', 'status_code' => 201], 201);
    }
    catch(\Exception $e){
        return response()->json([
            'error' => 'Gagal menyimpan data',
            'message' => $e->getMessage(),
            'status_code' => 500
        ], 500);
    }

    }
}
