<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_pengawasan_minum_tablet;
use Faker\Provider\ar_EG\Person;
use Illuminate\Http\Request;

class PengawasanMinumTabletController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_pengawasan_minum_tablet::all();
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
            'bulan_ke' => 'required|integer|between:1,12',
            'tanggal' => 'required|date',
            'jam' => 'required',
        ]);

        try{
            $data = Form_pengawasan_minum_tablet::create($request->only([
                'pemeriksaan_id',
                'bulan_ke',
                'tanggal',
                'jam'
            ]));
            return $this->apiResponse('Data berhasil ditambahkan', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse('Gagal menambahkan data', $e->getMessage(), 500, true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Form_pengawasan_minum_tablet::find($id);
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
            'bulan_ke' => 'nullable|integer|between:1,12',
            'tanggal' => 'nullable|date',
            'jam' => 'nullable',
        ]);

        try{
            $data = Form_pengawasan_minum_tablet::find($id);
            $data->update($request->only([
                'pemeriksaan_id',
                'bulan_ke',
                'tanggal',
                'jam'
            ]));
            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse('Gagal mengubah data', $e->getMessage(), 500, true);
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
        $data = Form_pengawasan_minum_tablet ::where('pemeriksaan_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
