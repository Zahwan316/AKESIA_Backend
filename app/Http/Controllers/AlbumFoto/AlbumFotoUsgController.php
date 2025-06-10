<?php

namespace App\Http\Controllers\AlbumFoto;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Album_foto_usg;
use App\Models\User;
use Illuminate\Http\Request;

class AlbumFotoUsgController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Album_foto_usg::all();

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
            //'user_id' => 'required',
            'janin_id' => 'required',
            'nama' => 'required|string',
        ]);

        try{
            $user = User::where('id', auth()->guard()->user()->id)->first();
            $data = Album_foto_usg::create([
                'user_id' => $user->id,
                'janin_id' => $request->janin_id,
                'nama' => $request->nama
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
        $data = Album_foto_usg::findOrFail($id);
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
            'user_id' => 'nullable',
            'nama' => 'nullable|string',
            'janin_id' => 'nullable'
        ]);

        try{
            $data = Album_foto_usg::findOrFail($id);
            $data->update($request->only([
                'user_id', 'nama', 'janin_id'
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
        $data = Album_foto_usg::findOrFail($id);
        $data->delete();
        return $this->apiResponse('Data berhasil dihapus');
    }

    public function getItemByJaninId($id){
        $data = Album_foto_usg::where('janin_id', $id)->get();
        return $this->apiResponse('Data berhasil diambil', $data);
    }
}
