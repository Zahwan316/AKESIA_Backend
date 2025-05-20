<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_riwayat_kehamilan_sebelumnya;
use Illuminate\Http\Request;

class RiwayatKehamilanSebelumnyaController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_riwayat_kehamilan_sebelumnya::all();

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
            'pemeriksaan_id' => 'required|integer|exists:pendaftarans,id',
            'anak_ke' => 'required|integer',
            'apiah' => 'required|string',
            'umur_anak' => 'required|integer',
            'p_l' => 'required|string',
            'bbl' => 'required|integer',
            'cara_persalinan' => 'required|string',
            'penolong' => 'required|string',
            'tempat_persalinan' => 'required|string',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try{
            $data = Form_riwayat_kehamilan_sebelumnya::create($request->all());
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
        $data = Form_riwayat_kehamilan_sebelumnya::find($id);
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
            'pemeriksaan_id' => 'nullable|integer|exists:pendaftarans,id',
            'umur_anak' => 'nullable|integer',
            'apiah' => 'nullable|string',
            'p_l' => 'nullable|string',
            'bbl' => 'nullable|integer',
            'cara_persalinan' => 'nullable|string',
            'penolong' => 'nullable|string',
            'tempat_persalinan' => 'nullable|string',
            'keterangan' => 'nullable|string|max:255',
        ]);

        try{
            $data = Form_riwayat_kehamilan_sebelumnya::findOrFail($id);
            $data->update($request->only([
                'pemeriksaan_id',
                'umur_anak',
                'apiah',
                'p_l',
                'bbl',
                'cara_persalinan',
                'penolong',
                'tempat_persalinan',
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
        $data = Form_riwayat_kehamilan_sebelumnya::where('pemeriksaan_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
