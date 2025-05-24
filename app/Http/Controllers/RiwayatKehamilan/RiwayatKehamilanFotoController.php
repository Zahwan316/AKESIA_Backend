<?php

namespace App\Http\Controllers\RiwayatKehamilan;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\riwayat_kehamilan_foto;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatKehamilanFotoController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = riwayat_kehamilan_foto::with('upload')->get();

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
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'riwayat_kehamilan_group_id' => 'required'
        ]);

        try{
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('uploads', 'public'); // disimpan di storage/app/public/uploads
                // 2. Simpan ke tabel uploads
                $upload = Upload::create([
                    'path' => 'storage/' . $path, // jika ingin bisa diakses langsung lewat URL
                    'user_id' => auth()->guard()->user()->id,    // atau sesuai kebutuhan kamu
                ]);
            }
            $data = riwayat_kehamilan_foto::create([
                'img_id' => $upload->id,
                'nama' => $request->nama,
                'riwayat_kehamilan_group_id' => $request->riwayat_kehamilan_group_id,
                'user_id' => auth()->guard()->user()->id,
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
        $data = riwayat_kehamilan_foto::with('upload')->findOrFail($id);
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
            'riwayat_kehamilan_group_id' => 'nullable'
        ]);
        try{
            $data = riwayat_kehamilan_foto::findOrFail($id);
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('uploads', 'public'); // disimpan di storage/app/public/uploads
                // 2. Simpan ke tabel uploads
                $upload = Upload::create([
                    'path' => 'storage/' . $path, // jika ingin bisa diakses langsung lewat URL
                    'user_id' => auth()->guard()->user()->id,    // atau sesuai kebutuhan kamu
                ]);
                $data->img_id = $upload->id;

            }
            $data->update($request->only([
                'nama',
                'riwayat_kehamilan_group_id'
            ]));
            $data->save();
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
        $data = riwayat_kehamilan_foto::findOrFail($id);
        $upload = Upload::findOrFail($data->img_id);

        try{
            // Hapus file dari storage jika ada
            if ($upload->path && Storage::disk('public')->exists(str_replace('storage/', '', $upload->path))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $upload->path));
            }
            $upload->delete();
            $data->delete();
            return $this->apiResponse('Data berhasil dihapus');
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), null, 400, true);
        }
            // Hapus record dari database
    }

    public function getByGroupId($id){
        $data = riwayat_kehamilan_foto::with('upload')->where('riwayat_kehamilan_group_id', $id)->get();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
