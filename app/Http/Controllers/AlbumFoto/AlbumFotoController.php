<?php

namespace App\Http\Controllers\AlbumFoto;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Album_foto;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumFotoController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Album_foto::with('uploads', 'usg')->get();

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
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'usg_id' => 'required|exists:album_foto_usgs,id',
            'judul' => 'nullable|string',
            'caption' => 'nullable|string',
            'tanggal' => 'nullable'
        ]);

        try{
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('uploads', 'public'); // disimpan di storage/app/public/uploads
                // 2. Simpan ke tabel uploads
                $upload = Upload::create([
                    'path' => 'storage/' . $path, // jika ingin bisa diakses langsung lewat URL
                    'user_id' => auth()->guard()->user()->id,    // atau sesuai kebutuhan kamu
                ]);

                $data = Album_foto::create([
                    'img_id' => $upload->id,
                    'judul' => $request->judul,
                    'caption' => $request->caption,
                    'tanggal' => now(),
                    'user_id' => auth()->guard()->user()->id,
                    'usg_id' => $request->usg_id
                ]);

                return $this->apiResponse('Data berhasil disimpan', $data);
            } else {
                return $this->apiResponse('Gambar tidak ditemukan', null, 400, true);
            }
            }
        catch(\Exception $e){
                return $this->apiResponse($e->getMessage(), null, 400, true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Album_foto::with('uploads')->find($id);
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
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            'user_id' => 'nullable|exists:users,id',
            'usg_id' => 'nullable|exists:album_foto_usgs,id',
            'judul' => 'nullable|string',
            'caption' => 'nullable|string',
            'tanggal' => 'nullable'
        ]);

        try{
            $data = Album_foto::findOrFail($id);
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('uploads', 'public'); // disimpan di storage/app/public/uploads
                // 2. Simpan ke tabel uploads
                $upload = Upload::create([
                    'path' => 'storage/' . $path,
                    'user_id' => auth()->guard()->user()->id,
                ]);
                $data->img_id = $upload->id;
                /* $data->update([
                    'img_id' => $upload->id,
                    'judul' => $request->judul,
                    'caption' => $request->caption,
                    'tanggal' => $request->tanggal,
                ]); */
                $data->save();

            }
            return $this->apiResponse('Data berhasil diedit', $data);
            }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), null, 400, true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Album_foto::findOrFail($id);
        $upload = Upload::findOrFail($data->img_id);


        try{
            // Hapus file dari storage jika ada
            if ($upload->path && Storage::disk('public')->exists(str_replace('storage/', '', $upload->path))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $upload->path));
            }

            // Hapus record dari database
            $upload->delete();
            $data->delete();
            return $this->apiResponse('Data berhasil dihapus');
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), null, 400, true);
        }
    }

    public function getItemByUsgId(string $id){
        $data = Album_foto::with('uploads', 'usg')->where('usg_id', $id)->get();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
