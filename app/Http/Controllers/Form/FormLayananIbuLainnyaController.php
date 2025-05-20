<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_layanan_ibu_lainnya;
use Illuminate\Http\Request;

class FormLayananIbuLainnyaController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_layanan_ibu_lainnya::all();
        return $this->apiResponse(  'Data berhasil diambil',$data);
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
            'pemeriksaan_id' => 'required|integer|exists:pendaftarans,id',
            'nama_ibu' => 'required|string|max:120',
            'umur_ibu' => 'required|integer|between:1,100',
            'booking_layanan' => 'required|string|max:255',
            'catatan_soap' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try{
            $data = Form_layanan_ibu_lainnya::create($request->only([
                'pemeriksaan_id',
                'nama_ibu',
                'umur_ibu',
                'booking_layanan',
                'catatan_soap',
                'keterangan',
            ]));
            return $this->apiResponse('Data berhasil ditambahkan', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'',500, true );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            'pemeriksaan_id' => 'nullable|integer|exists:pendaftarans,id',
            'nama_ibu' => 'nullable|string|max:120',
            'umur_ibu' => 'nullable|integer|between:1,100',
            'booking_layanan' => 'nullable|string|max:255',
            'catatan_soap' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try{
            $data = Form_layanan_ibu_lainnya::findOrFail($id);
            $data->update($request->only([
                'pemeriksaan_id',
                'nama_ibu',
                'umur_ibu',
                'booking_layanan',
                'catatan_soap',
                'keterangan',
            ]));
            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'',500, true );
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
        $data = Form_layanan_ibu_lainnya::where('pemeriksaan_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
