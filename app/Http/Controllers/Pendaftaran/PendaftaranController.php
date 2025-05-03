<?php

namespace App\Http\Controllers\Pendaftaran;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pendaftaran = Pendaftaran::paginate();
        return $this->apiResponse('Data berhasil diambil', $pendaftaran);
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
            'ibu_id' => 'required',
            'bidan_id' => 'nullable',
            'pelayanan_id' => 'required',
            'tanggal_pendaftaran' => 'required',
            'jam_pendaftaran' => 'required',
            'status' => 'nullable',
            'keluhan' => 'required',
            'nama_anak' => 'required',
            'umur_anak' => 'required',
        ]);

        try{
            $pendaftaran = Pendaftaran::create($request->only([
                'ibu_id', 'bidan_id', 'pelayanan_id', 'tanggal_pendaftaran', 'jam_pendaftaran', 'status', 'keluhan', 'nama_anak', 'umur_anak', 'status' => 'Menunggu Konfirmasi'
            ]));

            return $this->apiResponse('Data berhasil disimpan', $pendaftaran);
        }
        catch(\Exception $e){
            return $this->apiResponse('Gagal menyimpan data', $e->getMessage(), 500, true);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pendaftaran = Pendaftaran::find($id);
        return $this->apiResponse('Data berhasil diambil', $pendaftaran);
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
            'ibu_id' => 'required',
            'bidan_id' => 'nullable',
            'pelayanan_id' => 'required',
            'tanggal_pendaftaran' => 'required',
            'jam_pendaftaran' => 'required',
            'status' => 'nullable',
            'keluhan' => 'required',
            'nama_anak' => 'required',
            'umur_anak' => 'required',
        ]);

        try{
            $pendaftaran = Pendaftaran::find($id);
            $pendaftaran->update($request->only([
                'ibu_id', 'bidan_id', 'pelayanan_id', 'tanggal_pendaftaran', 'jam_pendaftaran', 'status', 'keluhan', 'nama_anak', 'umur_anak', 'status'
            ]));
            return $this->apiResponse('Data berhasil disimpan', $pendaftaran);
        }
        catch(\Exception $e){
            return $this->apiResponse('Gagal menyimpan data', $e->getMessage(), 500, true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->delete();
        return $this->apiResponse('Data berhasil dihapus');
    }
}
