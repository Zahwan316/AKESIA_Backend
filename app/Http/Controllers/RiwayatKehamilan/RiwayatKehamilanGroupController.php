<?php

namespace App\Http\Controllers\RiwayatKehamilan;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\riwayat_kehamilan_group;
use Illuminate\Http\Request;

class RiwayatKehamilanGroupController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = riwayat_kehamilan_group::all();
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
            'nama' => 'required',
        ]);

        try{
            $data = riwayat_kehamilan_group::create([
                'user_id' => auth()->guard()->user()->id,
                'nama' => $request->nama
            ]);
            return $this->apiResponse('Data berhasil ditambahkan', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), '');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = riwayat_kehamilan_group::findOrFail($id);
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
            'nama' => 'nullable',
        ]);

        try{
            $data = riwayat_kehamilan_group::findOrFail($id);
            $data->update([
                'nama' => $request->nama
            ]);
            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), '');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = riwayat_kehamilan_group::findOrFail($id);
        $data->delete();
        return $this->apiResponse('Data berhasil dihapus');
    }

    public function getByUserId(){
        $data = riwayat_kehamilan_group::where('user_id', auth()->guard()->user()->id)->get();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
