<?php

namespace App\Http\Controllers\Pendaftaran;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Ibu;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = $request->query('tanggal');

        if($query){
            //$tanggal = Carbon::createFromFormat('d/m/Y', $query)->format('Y-m-d');
            $pendaftaran = Pendaftaran::with('pelayanan', 'bayi', 'ibu.user')
            ->whereDate('created_at', $query)
            ->orderBy('created_at', 'desc')
            ->get();
        }
        else
        {
            $pendaftaran = Pendaftaran::with('pelayanan', 'bayi', 'ibu.user')
            ->orderBy('created_at', 'desc')
            ->get();
        }
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
            //'ibu_id' => 'required',
            'bidan_id' => 'nullable',
            'pelayanan_id' => 'required',
            'tanggal_pendaftaran' => 'required',
            'jam_pendaftaran' => 'nullable',
            'jam_ditentukan' => 'nullable',
            'status' => 'nullable',
            'keluhan' => 'required',
            'bayi_id' => 'nullable',
            'isVerif' => 'nullable',
        ]);

        try{
            $ibu = Ibu::where('user_id', auth()->guard()->user()->id)->first();

            $pendaftaran = Pendaftaran::create([
                'ibu_id' => $ibu->id,
                'bidan_id' => $request->bidan_id,
                'pelayanan_id' => $request->pelayanan_id,
                'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
                'jam_pendaftaran' => $request->jam_pendaftaran,
                'status' => 'Menunggu Konfirmasi',
                'keluhan' => $request->keluhan,
                'bayi_id' => $request->bayi_id,
                'isVerif' => false,
            ]);

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
        $pendaftaran = Pendaftaran::with(['pelayanan', 'ibu.user'])->find($id);
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
            //'ibu_id' => 'required',
            'bidan_id' => 'nullable',
            'pelayanan_id' => 'nullable',
            'tanggal_pendaftaran' => 'nullable',
            'jam_pendaftaran' => 'nullable',
            'status' => 'nullable',
            'keluhan' => 'nullable',
            'bayi_id' => 'nullable',
            'isVerif' => 'nullable',
        ]);

        try{
            $pendaftaran = Pendaftaran::find($id);
            $pendaftaran->update($request->only([
                'ibu_id', 'bidan_id', 'pelayanan_id', 'tanggal_pendaftaran', 'jam_pendaftaran', 'status', 'keluhan', 'nama_anak', 'umur_anak', 'status', 'bayi_id', 'isVerif'
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

    public function getCurrUserPendaftaran(){
        $ibu = Ibu::where('user_id', auth()->guard()->user()->id)->first();
        $data = Pendaftaran::where('ibu_id', $ibu->id)->with('pelayanan')->orderBy('created_at', 'desc')->get();
        //dd($data);

        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }
}
