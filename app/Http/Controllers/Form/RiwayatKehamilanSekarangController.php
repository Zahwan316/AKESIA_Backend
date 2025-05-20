<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_riwayat_kehamilan_sekarang;
use Illuminate\Http\Request;

class RiwayatKehamilanSekarangController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_riwayat_kehamilan_sekarang::all();

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
            'pemeriksaan_id' => 'required|integer|exists:pemeriksaans,id',
            'gravida' => 'required|integer',
            'partus' => 'required|integer',
            'rr_rt' => 'required|string|max:255',
            'hpl' => 'nullable',
            'hpht' => 'nullable',
            'muntah' => 'required|string',
            'pusing' => 'required|string',
            'nyeri_perut' => 'required|string',
            'nafsu_makan' => 'required|string',
            'pendarahan' => 'required|string',
            'riwayat_penyakit' => 'nullable|string|max:255',
            'riwayat_penyakit_keluarga' => 'nullable|string|max:255',
            'kebiasaan' => 'nullable|string|max:255',
            'keluhan' => 'nullable|string|max:255',
            'pasangan_sexual_istri' => 'required|string',
            'pasangan_sexual_suami' => 'required|string',
            'mendiskusikan_hiv' => 'required|string'
        ]);

        try{
            $data = Form_riwayat_kehamilan_sekarang::create($request->all());
            return $this->apiResponse('Data berhasil ditambahkan', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'', 500, true );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Form_riwayat_kehamilan_sekarang::find($id);
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
            'pemeriksaan_id' => 'nullable|integer|exists:pemeriksaans,id',
            'gravida' => 'nullable|integer',
            'partus' => 'nullable|integer',
            'rr_rt' => 'nullable|string|max:255',
            'hpl' => 'nullable',
            'hpht' => 'nullable',
            'muntah' => 'nullable|string',
            'pusing' => 'nullable|string',
            'nyeri_perut' => 'nullable|string',
            'nafsu_makan' => 'nullable|string',
            'pendarahan' => 'nullable|string',
            'riwayat_penyakit' => 'nullable|string|max:255',
            'riwayat_penyakit_keluarga' => 'nullable|string|max:255',
            'kebiasaan' => 'nullable|string|max:255',
            'keluhan' => 'nullable|string|max:255',
            'pasangan_sexual_istri' => 'nullable|string',
            'pasangan_sexual_suami' => 'nullable|string',
            'mendiskusikan_hiv' => 'nullable|string'
        ]);

        try{
            $data = Form_riwayat_kehamilan_sekarang::findOrFail($id);
            $data->update($request->only([
                'pemeriksaan_id',
                'gravida',
                'partus',
                'rr_rt',
                'hpl',
                'hpht',
                'muntah',
                'pusing',
                'nyeri_perut',
                'nafsu_makan',
                'pendarahan',
                'riwayat_penyakit',
                'riwayat_penyakit_keluarga',
                'kebiasaan',
                'keluhan',
                'pasangan_sexual_istri',
                'pasangan_sexual_suami',
                'mendiskusikan_hiv',
            ]));
            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'', 500, true );
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
        $data = Form_riwayat_kehamilan_sekarang::where('pemeriksaan_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
