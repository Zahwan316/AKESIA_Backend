<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_bayi_saat_lahir;
use Illuminate\Http\Request;

class BayiSaatLahirController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_bayi_saat_lahir::all();
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
            'anak_ke' => 'required|integer',
            'berat_lahir' => 'required|numeric',
            'panjang_badan' => 'required|numeric',
            'lingkar_kepala' => 'required|numeric',
            'jenis_kelamin' => 'required|string',
            'kondisi_bayi_saat_lahir' => 'required|string',
            'asuhan_bayi_baru_lahir' => 'required|string'
        ]);

        try{
            $data = Form_bayi_saat_lahir::create($request->all());
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
        $data = Form_bayi_saat_lahir::find($id);
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
            'anak_ke' => 'nullable|integer',
            'berat_lahir' => 'nullable|numeric',
            'panjang_badan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'jenis_kelamin' => 'nullable|string',
            'kondisi_bayi_saat_lahir' => 'nullable|string',
            'asuhan_bayi_baru_lahir' => 'nullable|string'
        ]);

        try {
            $data = Form_bayi_saat_lahir::findOrFail($id);
            $data->update($request->only([
                'pendaftaran_id',
                'anak_ke',
                'berat_lahir',
                'panjang_badan',
                'lingkar_kepala',
                'jenis_kelamin',
                'kondisi_bayi_saat_lahir',
                'asuhan_bayi_baru_lahir',
            ]));
            return $this->apiResponse('Data berhasil diubah', $data);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(), '', 500, true);
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
        $data = Form_bayi_saat_lahir::where('pendaftaran_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
