<?php

namespace App\Http\Controllers\Banner;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Upload;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Banner::with('upload')->get();

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
        $request->validate( [
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'name' => 'required'
        ]);

        try{
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('uploads', 'public'); // disimpan di storage/app/public/uploads
                // 2. Simpan ke tabel uploads
                $upload = Upload::create([
                    'path' => 'storage/' . $path, // jika ingin bisa diakses langsung lewat URL
                    'user_id' => auth()->guard()->user()->id,    // atau sesuai kebutuhan kamu
                ]);

                $data = Banner::create([
                    'name' => $request->name,
                    'img_id' => $upload->id
                ]);

                return $this->apiResponse('Data berhasil disimpan', $data);
            } else {
                return $this->apiResponse('Gambar tidak ditemukan', null, 400, true);
            }
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'',500, true );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
