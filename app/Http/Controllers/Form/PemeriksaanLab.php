<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_pemeriksaan_lab;
use Illuminate\Http\Request;

class PemeriksaanLab extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_pemeriksaan_lab::all();
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
            'tanggal_pemeriksaan' => 'nullable|date',
            'jam_pemeriksaan' => 'nullable|date_format:H:i',
            'nama' => 'nullable|string|max:255',
            'hasil' => 'nullable|string|max:255',
            'tanggal_pelayanan' => 'required|date',
            'jam_pelayanan' => 'required|date_format:H:i',
            'soap' => 'required|string|max:255',
            'penatalaksanaan' => 'required|string|max:255'
        ]);

        try{
            $data = Form_pemeriksaan_lab::create($request->only([
                'pemeriksaan_id',
                'tanggal_pemeriksaan',
                'jam_pemeriksaan',
                'nama',
                'hasil',
                'tanggal_pelayanan',
                'jam_pelayanan',
                'soap',
                'penatalaksanaan'
            ]));
            return $this->apiResponse('Data berhasil disimpan', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), $validate, 500, true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Form_pemeriksaan_lab::find($id);
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
            //'pemeriksaan_id' => 'nullable|integer|exists:pemeriksaans,id',
            'tanggal_pemeriksaan' => 'nullable|date',
            'jam_pemeriksaan' => 'nullable',
            'nama' => 'nullable|string|max:255',
            'hasil' => 'nullable|string|max:255',
            'tanggal_pelayanan' => 'nullable|date',
            'jam_pelayanan' => 'nullable',
            'soap' => 'nullable|string|max:255',
            'penatalaksanaan' => 'nullable|string|max:255'
        ]);

        try{
            $data = Form_pemeriksaan_lab::find($id);
            $data->update($request->only([
                'pemeriksaan_id',
                'tanggal_pemeriksaan',
                'jam_pemeriksaan',
                'nama',
                'hasil',
                'tanggal_pelayanan',
                'jam_pelayanan',
                'soap',
                'penatalaksanaan'
            ]));
            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), $validate,500, true);
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
        $data = Form_pemeriksaan_lab::where('pemeriksaan_id', $id)->first();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
