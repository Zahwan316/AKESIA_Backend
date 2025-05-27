<?php

namespace App\Http\Controllers\Pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\Bidan;
use App\Models\Pemeriksaan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $tanggal = $request->query();

        if($tanggal){
            $data = Pendaftaran::with(['pelayanan', 'ibu.user'])->whereDate('created_at', $tanggal)->paginate(10);
        }
        else{
            $data = Pendaftaran::with(['pelayanan', 'ibu.user'])->whereDate('created_at', now())->paginate(10);
        }

        return view('admin.pendaftaran.index', compact('data'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Pendaftaran::with(['pelayanan', 'ibu.user'])->find($id);
        //dd($id, $data);
        $bidan = Bidan::with('user')->get();

        return view('admin.pendaftaran.edit', compact(['data', 'bidan']));
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
            'bidan_id' => 'nullable',
            'pelayanan_id' => 'nullable',
            'tanggal_pendaftaran' => 'nullable',
            'jam_pendaftaran' => 'nullable',
            'jam_ditentukan' => 'nullable',
            'status' => 'nullable',
            'keluhan' => 'nullable',
            'bayi_id' => 'nullable',
            'isVerif' => 'nullable',
        ]);

        try{
            $data = Pendaftaran::find($id);
            $this->verifikasi($id);
            $data->update($request->only([
                'bidan_id', 'pelayanan_id', 'tanggal_pendaftaran', 'jam_pendaftaran', 'jam_ditentukan', 'status', 'keluhan', 'bayi_id', 'isVerif'
            ]));
            return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil disimpan');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function verifikasi(string $id){
        $data = Pendaftaran::find($id);
        if($data->bidan_id === null){
            return redirect()->route('pendaftaran.index')->with('error', 'Tentukan terlebih dahulu untuk bidan dan jam pemeriksaan!!');
        }
        $data->isVerif = 1;
        $data->save();

        Pemeriksaan::create([
            'pendaftaran_id' => $data->id,
            'bidan_id' => $data->bidan_id,
            'pelayanan_id' => $data->pelayanan_id,
            'ibu_id' => $data->ibu_id,
            'tanggal_kunjungan' => $data->tanggal_pendaftaran,
            'jam_kunjungan' => $data->jam_ditentukan,
            'harga' => $data->pelayanan->harga,

        ]);


        return redirect()->route('pendaftaran.index')->with('success', 'Berhasil Diverifikasi');
    }
}
