<?php

namespace App\Http\Controllers\Bayi;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Bayi;
use App\Models\Ibu;
use Illuminate\Http\Request;

class BayiController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Bayi = Bayi::paginate(10);
        return $this->apiResponse('Data berhasil diambil', $Bayi);
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
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|string|max:2',
            'nik' => 'nullable|string|size:16|unique:bayis,nik',
            'golongan_darah' => 'nullable|string|max:4',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'no_akta_kelahiran' => 'nullable|unique:bayis,no_akta_kelahiran',
            'no_registrasi_kohort_bayi' => 'nullable|unique:bayis,no_registrasi_kohort_bayi',
            'no_registrasi_kohort_balita' => 'nullable|unique:bayis,no_registrasi_kohort_balita',
            'no_registrasi_kohort_ibu' => 'nullable|unique:bayis,no_registrasi_kohort_ibu',
            'no_catatan_medik_rs' => 'nullable|unique:bayis,no_catatan_medik_rs',
            'anak_ke' => 'required|integer|min:1',
        ]);

        try{
            $ibu_id = Ibu::where('user_id', auth()->guard()->user()->id)->first();

            $bayi = Bayi::create([
                'ibu_id' => $ibu_id->id,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nik' => $request->nik,
                'golongan_darah' => $request->golongan_darah,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_akta_kelahiran' => $request->no_akta_kelahiran,
                'no_registrasi_kohort_bayi' => $request->no_registrasi_kohort_bayi,
                'no_registrasi_kohort_balita' => $request->no_registrasi_kohort_balita,
                'no_registrasi_kohort_ibu' => $request->no_registrasi_kohort_ibu,
                'no_catatan_medik_rs' => $request->no_catatan_medik_rs,
                'anak_ke' => $request->anak_ke,
            ]);
            return $this->apiResponse('Data berhasil ditambahkan', $bayi);
        }
        catch(\Exception $e){
            return $this->apiResponse('Gagal menambahkan data', $e->getMessage(), 500, true);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $bayi = Bayi::find($id);
        return $this->apiResponse('Data berhasil diambil', $bayi);
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
            'ibu_id' => 'nullable|exists:ibus,id',
            'nama_lengkap' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|max:2',
            'nik' => 'nullable|string|size:16|unique:bayis,nik',
            'golongan_darah' => 'nullable|string|max:4',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'no_akta_kelahiran' => 'nullable|string',
            'no_registrasi_kohort_bayi' => 'nullable',
            'no_registrasi_kohort_balita' => 'nullable',
            'no_registrasi_kohort_ibu' => 'nullable',
            'no_catatan_medik_rs' => 'nullable',
            'anak_ke' => 'nullable|integer|min:1',
        ]);

        try{
            $bayi = Bayi::findOrFail($id);

            $bayi->update($request->only([
                'ibu_id',
                'nama_lengkap',
                'jenis_kelamin',
                'nik',
                'golongan_darah',
                'tempat_lahir',
                'tanggal_lahir',
                'no_akta_kelahiran',
                'no_registrasi_kohort_bayi',
                'no_registrasi_kohort_balita',
                'no_registrasi_kohort_ibu',
                'no_catatan_medik_rs',
                'anak_ke',
            ]));

            return $this->apiResponse('Data berhasil diubah', $bayi);
        }
        catch(\Exception $e){
            return $this->apiResponse('Gagal menambahkan data', $e->getMessage(), 500, true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $bayi = Bayi::findOrFail($id);
            $bayi->delete();
            return $this->apiResponse('Data berhasil dihapus');
        }
        catch(\Exception $e){
            return $this->apiResponse('Gagal menghapus data', $e->getMessage());
        }

    }

    public function getAnak(){
        $ibu_id = Ibu::where('user_id', auth()->guard()->user()->id)->first();
        $anak = Bayi::where('ibu_id', $ibu_id->id)->get();
        return $this->apiResponse('Data berhasil diambil', $anak);
    }
}
