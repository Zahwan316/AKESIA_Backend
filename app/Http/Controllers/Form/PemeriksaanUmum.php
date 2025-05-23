<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_pemeriksaan_umum;
use App\Models\Notification;
use Illuminate\Http\Request;

class PemeriksaanUmum extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_pemeriksaan_umum::all();

        return $this->apiResponse('Data berhasil diambil', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'bentuk_tubuh' => 'required',
            'kesadaran_id' => 'required',
            'mata' => 'required',
            'leher' => 'required',
            'payudara' => 'required',
            'paru' => 'required',
            'jantung' => 'required',
            'hati' => 'required',
            'suhu_badan' => 'required',
            'genetalia' => 'required',
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|numeric',
            'pemeriksaan_id' => 'required',
            'tanggal_kontrol_kembali' => 'nullable',
            'user_id' => 'required'
        ]);

        try{
            $notif = Notification::create([
                'user_id' => $request->user_id,
                'title' => 'Haloo mak',
                'message' => 'Kontrol lagi yuk di tanggal '. $request->tanggal_kontrol_kembali,
            ]);

            $data = Form_pemeriksaan_umum::create($request->only([
                'bentuk_tubuh',
                'kesadaran_id',
                'mata',
                'leher',
                'payudara',
                'paru',
                'jantung',
                'hati',
                'suhu_badan',
                'genetalia',
                'tinggi_badan',
                'berat_badan',
                'pemeriksaan_id',
                'tanggal_kontrol_kembali'
            ]));

            return $this->apiResponse('Data berhasil dibuat', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse( $e->getMessage(), '', 500 ,true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Form_pemeriksaan_umum::find($id);
        return $this->apiResponse('Data berhasil diambil', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validate = $request->validate([
            'bentuk_tubuh' => 'required',
            'kesadaran_id' => 'required',
            'mata' => 'required',
            'leher' => 'required',
            'payudara' => 'required',
            'paru' => 'required',
            'jantung' => 'required',
            'hati' => 'required',
            'suhu_badan' => 'required',
            'genetalia' => 'required',
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|numeric',
            'pemeriksaan_id' => 'required',
            'tanggal_kontrol_kembali' => 'nullable'
        ]);

        try{
            $notif = Notification::create([
                'user_id' => $request->user_id,
                'title' => 'Haloo mak',
                'message' => 'Kontrol lagi yuk di tanggal '. $request->tanggal_kontrol_kembali,
            ]);

            $data = Form_pemeriksaan_umum::find($id);
            $data->update($request->only([
                'bentuk_tubuh',
                'kesadaran_id',
                'mata',
                'leher',
                'payudara',
                'paru',
                'jantung',
                'hati',
                'suhu_badan',
                'genetalia',
                'tinggi_badan',
                'berat_badan',
                'pemeriksaan_id',
                'tanggal_kontrol_kembali'
            ]));

            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse( $e->getMessage(), '', 500 ,true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showFormByPendaftaran(string $id){
        $data = Form_pemeriksaan_umum::where('pemeriksaan_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
