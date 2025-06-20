<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Jenis_layanan;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisPelayananWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Jenis_layanan::with('upload')->paginate(10);

        return view('admin.jenis_pelayanan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.jenis_pelayanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'nama' => 'required|string',
            'keterangan' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try{
            if($request->has('img')){
                $path = $request->file('img')->store('uploads', 'public');
                $upload = Upload::create([
                    'path' => 'storage/'.$path,
                    'user_id' => 1,
                ]);
            }
            $data = Jenis_layanan::create([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'img_id' => $upload->id
            ]);

            return redirect()->route('jenis_layanan.index')->with(['success' => 'Data berhasil disimpan']);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
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
        $data = Jenis_layanan::with('upload')->find($id);

        return view('admin.jenis_pelayanan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validate = $request->validate([
            'nama' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try{
            $data = Jenis_layanan::findOrFail($id);

            if($request->has('img')){
                //add new image
                $path = $request->file('img')->store('uploads', 'public');
                $upload = Upload::create([
                    'path' => 'storage/'.$path,
                    'user_id' => 1,
                ]);
                $data->img_id = $upload->id;
            }

            $data->update([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]);

            return redirect()->route('jenis_layanan.index')->with(['success' => 'Data berhasil diupdate']);

        }
        catch(\Exception $e){
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Jenis_layanan::findOrFail($id);

        if ($data->img_id) {
            $upload = Upload::find($data->img_id);
            if ($upload && Storage::disk('public')->exists($upload->path)) {
                Storage::disk('public')->delete($upload->path);
            }

            // Hapus entri upload
            if ($upload) {
                $upload->delete();
            }
        }
        $data->delete();

        return redirect()->route('jenis_layanan.index')->with(['success' => 'Data berhasil dihapus']);
    }
}
