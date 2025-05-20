<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_Pelayanan_Bayi;
use Illuminate\Http\Request;

class PelayananBayiController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_Pelayanan_Bayi::all();

        return $this->apiResponse('Data berhasil diambil',$data);
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
            'nama_bayi' => 'required|string|max:255',
            'umur_bayi' => 'required|integer',
            'jenis_kelamin_bayi' => 'required|string',
            'booking_layanan' => 'required|string|max:255',
            'keterangan_kondisi_bayi' => 'required|string|max:255',
            'tambahan_layanan_id' => 'nullable|integer|exists:tambahan_layanans,id'
        ]);

        try{
            $data = Form_Pelayanan_Bayi::create( $request->only([
                'pemeriksaan_id',
                'nama_bayi',
                'umur_bayi',
                'jenis_kelamin_bayi',
                'booking_layanan',
                'keterangan_kondisi_bayi',
                'tambahan_layanan_id',
            ]) );
            return $this->apiResponse('Data berhasil ditambahkan', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'',500, true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Form_Pelayanan_Bayi::find($id);
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
            'pemeriksaan_id' => 'nullable|exists:pendaftarans,id',
            'nama_bayi' => 'nullable|string|max:255',
            'umur_bayi' => 'nullable|integer|min:0',
            'jenis_kelamin_bayi' => 'nullable|string',
            'booking_layanan' => 'nullable|string|max:255',
            'keterangan_kondisi_bayi' => 'nullable|string',
            'tambahan_layanan_id' => 'nullable|exists:tambahan_layanans,id',
        ]);

        try{
            $data = Form_Pelayanan_Bayi::findOrFail($id);
            $data->update($request->only([
                'pemeriksaan_id',
                'nama_bayi',
                'umur_bayi',
                'jenis_kelamin_bayi',
                'booking_layanan',
                'keterangan_kondisi_bayi',
                'tambahan_layanan_id',
            ]));
            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'',500, true);
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
        $data = Form_Pelayanan_Bayi::where('pemeriksaan_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
