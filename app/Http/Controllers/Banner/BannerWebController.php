<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Banner::with('upload')->paginate(10);

        return view('admin.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'name' => 'required|string',
            'img' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        try{
            if($request->has('img')){
                $path = $request->file('img')->store('uploads', 'public');
                $upload = Upload::create([
                    'path' => 'storage/'.$path,
                    'user_id' => 1,
                ]);
            }
            $data = Banner::create([
                'name' => $request->name,
                'img_id' => $upload->id
            ]);

            return redirect()->route('banner.index')->with(['success' => 'Data berhasil ditambahkan']);
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
        $data = Banner::with('upload')->findOrFail($id);

        return view('admin.banner.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validate = $request->validate([
            'name' => 'nullable|string',
            'img' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        try{
            $data = Banner::findOrFail($id);
            if($request->has('img')){
                $path = $request->file('img')->store('uploads', 'public');
                $upload = Upload::create([
                    'path' => 'storage/'.$path,
                    'user_id' => 1,
                ]);
                $data->img_id = $upload->id;
            }
            $data->update([
                'name' => $request->name,
            ]);

            return redirect()->route('banner.index')->with(['success' => 'Data berhasil diubah']);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Banner::findOrFail($id);
        try{
            if($data->img_id){
                $upload = Upload::find($data->img_id);
                if($upload && Storage::disk('public')->exists($upload->path)){
                    Storage::disk('public')->delete($upload->path);
                }

                // Hapus entri upload
                if($upload){
                    $upload->delete();
                }
            }

            $data->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
