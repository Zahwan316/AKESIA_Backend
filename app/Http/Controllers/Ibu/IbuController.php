<?php

namespace App\Http\Controllers\Ibu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ibu;
use App\Models\User;

class IbuController extends Controller
{
    public function GetDataIbu(string $user_id){
        $data = Ibu::with('User')->where("user_id",$user_id)->get();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }

    public function GetAllDataIbu(){
        $data = Ibu::all();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }

    public function GetCurrIbu(){
        $data = Ibu::with('User')->where("user_id",auth()->guard()->user()->id)->first();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }

    //
    public function LengkapiData(Request $request){
        $validate = $request->validate([
            'nik' => 'required|string|unique:ibus|size:16',
            'golongan_darah' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'alamat_domisili' => 'required',
            'telepon' => 'required|unique:ibus',
            'nama_lengkap' => 'required',
            'berat_badan' => 'nullable',
            'tinggi_badan' => 'nullable',
            'usia_kehamilan' => 'nullable',
            'hpht' => 'nullable'
        ]);

    try{
        /* $data = $request->only([
            'nik', 'golongan_darah', 'tempat_lahir', 'tanggal_lahir',
            'pendidikan', 'pekerjaan', 'alamat_domisili', 'telepon', 'user_id',
            'berat_badan', 'tinggi_badan', 'usia_kehamilan'
        ]); */
        $user = User::find(auth()->guard()->user()->id);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->save();

        $ibu = Ibu::create([
            'nik' => $request->nik,
            'golongan_darah' => $request->golongan_darah,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'alamat_domisili' => $request->alamat_domisili,
            'telepon' => $request->telepon,
            'user_id' => auth()->guard()->user()->id,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'usia_kehamilan' => $request->usia_kehamilan,
            'hpht' => $request->hpht,

        ]);
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

    public function UpdateData(Request $request, string $id){
        $validate = $request->validate([
            'nik' => 'nullable|size:16',
            'golongan_darah' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'pendidikan' => 'nullable',
            'pekerjaan' => 'nullable',
            'alamat_domisili' => 'nullable',
            'telepon' => 'nullable',
            'nama_lengkap' => 'nullable',
            'berat_badan' => 'nullable',
            'tinggi_badan' => 'nullable',
            'usia_kehamilan' => 'nullable',
            'hpht' => 'nullable'
        ]);

        try{
            $user = User::findOrFail(auth()->guard()->user()->id);
            $user->nama_lengkap = $request->nama_lengkap;
            $user->save();
            $data = Ibu::findOrFail($id);
            $data->update($request->only([
                'nik', 'golongan_darah', 'tempat_lahir', 'tanggal_lahir',
                'pendidikan', 'pekerjaan', 'alamat_domisili', 'telepon', 'user_id',
                'berat_badan', 'tinggi_badan', 'usia_kehamilan', 'hpht'
            ]));
            return response()->json(['message' => 'Data berhasil disimpan', 'status_code' => 201], 201);
        }
        catch(\exception $e){
            return response()->json([
                'error' => 'Gagal menyimpan data',
                'message' => $e->getMessage(),
                'status_code' => 500
            ], 500);
        }
    }
}
