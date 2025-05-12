<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_pelayanan_ibu_nifas;
use Illuminate\Http\Request;

class PelayananIbuNifasController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_pelayanan_ibu_nifas::all();
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
            'pendaftaran_id' => 'required|integer|exists:pendaftarans,id',
            'klasifikasi_nifas_1' => 'nullable|string|max:255',
            'tindakan_nifas_1' => 'nullable|string|max:255',
            'tanggal_nifas_1' => 'nullable|date',
            'klasifikasi_nifas_2' => 'nullable|string|max:255',
            'tindakan_nifas_2' => 'nullable|string|max:255',
            'tanggal_nifas_2' => 'nullable|date',
            'klasifikasi_nifas_3' => 'nullable|string|max:255',
            'tindakan_nifas_3' => 'nullable|string|max:255',
            'tanggal_nifas_3' => 'nullable|date',
        ]);

        try{
            $data = Form_pelayanan_ibu_nifas::create($request->only([
                'pendaftaran_id',
                'klasifikasi_nifas_1',
                'tindakan_nifas_1',
                'tanggal_nifas_1',
                'klasifikasi_nifas_2',
                'tindakan_nifas_2',
                'tanggal_nifas_2',
                'klasifikasi_nifas_3',
                'tindakan_nifas_3',
                'tanggal_nifas_3',
            ]));
            return $this->apiResponse('Data berhasil disimpan', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse('Data gagal disimpan', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Form_pelayanan_ibu_nifas::find($id);
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
            'pendaftaran_id' => 'nullable|exists:pendaftarans,id',
            'klasifikasi_nifas_1' => 'nullable|string|max:255',
            'tindakan_nifas_1' => 'nullable|string|max:255',
            'tanggal_nifas_1' => 'nullable|date',
            'klasifikasi_nifas_2' => 'nullable|string|max:255',
            'tindakan_nifas_2' => 'nullable|string|max:255',
            'tanggal_nifas_2' => 'nullable|date',
            'klasifikasi_nifas_3' => 'nullable|string|max:255',
            'tindakan_nifas_3' => 'nullable|string|max:255',
            'tanggal_nifas_3' => 'nullable|date',
        ]);

        try{
            $data = Form_pelayanan_ibu_nifas::find($id);
            $data->update($request->only([
                'pendaftaran_id',
                'klasifikasi_nifas_1',
                'tindakan_nifas_1',
                'tanggal_nifas_1',
                'klasifikasi_nifas_2',
                'tindakan_nifas_2',
                'tanggal_nifas_2',
                'klasifikasi_nifas_3',
                'tindakan_nifas_3',
                'tanggal_nifas_3',
            ]));
            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse('Data gagal diubah', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
