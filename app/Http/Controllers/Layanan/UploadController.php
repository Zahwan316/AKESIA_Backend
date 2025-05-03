<?php

namespace App\Http\Controllers\Layanan;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UploadController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Upload::all();
        return $this->apiResponse('Data berhaisl diambil', $data);
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
            'path' => 'required|string|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required',
        ]);

        try {
            // Simpan file ke folder 'uploads' di storage/app/public/uploads
            $imagePath = $request->file('path')->store('uploads', 'public');

            // Simpan ke database
            $upload = Upload::create([
                'path' => $imagePath,
                'user_id' => $request->user_id,
            ]);

            return $this->apiResponse('Data berhasil diupload', $upload, 201, false);
        } catch (\Exception $e) {
            return $this->apiResponse($e->getMessage(),'',500, true );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Upload::find($id);
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
        $validate = $request->validate( [
            'path' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required',
        ]);

        try {
            $upload = Upload::findOrFail($id);

            // Jika ada file baru diupload
            if ($request->hasFile('path')) {
                // Hapus file lama (jika ada)
                if ($upload->path && Storage::disk('public')->exists($upload->path)) {
                    Storage::disk('public')->delete($upload->path);
                }

                // Simpan file baru
                $newPath = $request->file('path')->store('uploads', 'public');
                $upload->path = $newPath;
            }

            // Update field lainnya
            $upload->user_id = $request->user_id;
            $upload->save();

            return $this->apiResponse('Data berhasil diedit', $upload, 201, false);
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
        $upload = Upload::find($id);

        if (!$upload) {
            return $this->apiResponse('Data tidak ditemukan', null, 404, true);
        }

        // Hapus file dari storage
        if ($upload->path && Storage::exists($upload->path)) {
            Storage::delete($upload->path);
        }

        // Hapus data dari database
        $upload->delete();

        return $this->apiResponse('Data berhasil dihapus');
    }
}
