<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Pelayanan::all();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
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
        $validate = $request->validate( [
            'jenis_layanan_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'kuantitas' => 'required',
            'keterangan' => 'required',
        ]);

        try{
            Pelayanan::create($request->only([
                'jenis_layanan_id', 'nama', 'kuantitas', 'keterangan', 'harga'
            ]));
            return response()->json(['message' => 'Data berhasil disimpan', 'status_code' => 201], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Gagal menyimpan data',
                'message' => $e->getMessage(),
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pelayanan = Pelayanan::find($id);
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $pelayanan, 'status_code' => 200, 'error' => false], 200);
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
        $validate = $request->validate( [
            'jenis_layanan_id' => 'nullable',
            'nama' => 'nullable',
            'harga' => 'nullable',
            'kuantitas' => 'nullable',
            'keterangan' => 'nullable',
        ]);

        try{
            $pelayanan = Pelayanan::find($id);
            $pelayanan->update($request->only([
                'jenis_layanan_id', 'nama', 'kuantitas', 'keterangan', 'harga'
            ]));
            return response()->json(['message' => 'Data berhasil disimpan', 'status_code' => 201], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Gagal menyimpan data',
                'message' => $e->getMessage(),
                'status_code' => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pelayanan = Pelayanan::find($id);
        $pelayanan->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status_code' => 200], 200);
    }
}
