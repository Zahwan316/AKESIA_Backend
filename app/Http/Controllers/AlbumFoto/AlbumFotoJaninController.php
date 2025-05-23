<?php

namespace App\Http\Controllers\AlbumFoto;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Album_foto_janin;
use App\Models\User;
use Illuminate\Http\Request;

class AlbumFotoJaninController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Album_foto_janin::with('usg')->get();

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
            'nama' => 'required|string',
        ]);

        try{
            $data = Album_foto_janin::create([
                'user_id' => auth()->guard()->user()->id,
                'nama' => $request->nama,
            ]);

            return $this->apiResponse('Data berhasil ditambahkan', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), '', 500, true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Album_foto_janin::findOrFail($id);

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
            'nama' => 'nullable|string',
        ]);
        try{
            $data = Album_foto_janin::findOrFail($id);
            $data->update($request->only([
                'nama'
            ]));
            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'',500, true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Album_foto_janin::findOrFail($id);
        $data->delete();
        return $this->apiResponse('Data berhasil dihapus');
    }

    public function getItemByUserId(){
        $data = Album_foto_janin::where('user_id', auth()->guard()->user()->id)->get();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
