<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_pelayanan_ibu_bersalin;
use Illuminate\Http\Request;

class PelayananIbuBersalinController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_pelayanan_ibu_bersalin::all();
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
            'tanggal_persalinan' => 'required|date',
            'jam_lahir' => 'required|date_format:H:i',
            'umur_kehamilan' => 'required|integer|between:1,42',
            'penolong_persalinan' => 'required|string',
            'cara_persalinan' => 'required|string',
            'keadaan_ibu' => 'required|string',
            'kb_pasca_persalinan' => 'required|string|in:Ya,Tidak',
            'keterangan_tambahan' => 'nullable|string|max:255'
        ]);

        try{
            $data = Form_pelayanan_ibu_bersalin::create($request->all());
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
        $data = Form_pelayanan_ibu_bersalin::find($id);
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
            'tanggal_persalinan' => 'nullable|date',
            'jam_lahir' => 'nullable|date_format:H:i:s',
            'umur_kehamilan' => 'nullable|integer|between:1,42',
            'penolong_persalinan' => 'nullable|string',
            'cara_persalinan' => 'nullable|string',
            'keadaan_ibu' => 'nullable|string',
            'kb_pasca_persalinan' => 'nullable|string|in:Ya,Tidak',
            'keterangan_tambahan' => 'nullable|string|max:255'
        ]);

        try{
            $data = Form_pelayanan_ibu_bersalin::findOrFail($id);
            $data->update($request->only([
                'pendaftaran_id',
                'tanggal_persalinan',
                'jam_lahir',
                'umur_kehamilan',
                'penolong_persalinan',
                'cara_persalinan',
                'keadaan_ibu',
                'kb_pasca_persalinan',
                'keterangan_tambahan',
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
        $data = Form_pelayanan_ibu_bersalin::where('pendaftaran_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
