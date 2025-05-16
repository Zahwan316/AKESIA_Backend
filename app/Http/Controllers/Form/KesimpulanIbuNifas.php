<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_kesimpulan_ibu_nifas;
use Illuminate\Http\Request;

class KesimpulanIbuNifas extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_kesimpulan_ibu_nifas::all();

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
            'keadaan_ibu' => 'nullable|string|max:255',
            'komplikasi_nifas' => 'nullable|string|max:255',
            'keadaan_bayi' => 'nullable|string|max:255',
        ]);

        try{
            $data = Form_kesimpulan_ibu_nifas::create($request->only([
                'pendaftaran_id',
                'keadaan_ibu',
                'komplikasi_nifas',
                'keadaan_bayi',
            ]));
            return $this->apiResponse('Data berhasil disimpan', $data);
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
        $data = Form_kesimpulan_ibu_nifas::find($id);
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
            'pendaftaran_id' => 'nullable|integer|exists:pendaftarans,id',
            'keadaan_ibu' => 'nullable|string|max:255',
            'komplikasi_nifas' => 'nullable|string|max:255',
            'keadaan_bayi' => 'nullable|string|max:255',
        ]);

        try{
            $data = Form_kesimpulan_ibu_nifas::findOrFail($id);
            $data->update($request->only([
                'pendaftaran_id',
                'keadaan_ibu',
                'komplikasi_nifas',
                'keadaan_bayi',
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
        $data = Form_kesimpulan_ibu_nifas::where('pendaftaran_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
