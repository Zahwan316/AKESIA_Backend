<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Bidan;
use App\Models\Ref_Kota;
use App\Models\Ref_Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BidanWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Bidan::with('user', 'provinsi.kota')->paginate(10);

        return view('admin.bidan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.bidan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        try{
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'bidan'
            ]);

            return redirect()->route('bidan.index')->with(['success' => 'Data berhasil disimpan, mohon bidan untuk mengisi kelengkapan data di aplikasi akesia android']);
        }
        catch(\Exception $e){
            return view('admin.bidan.create')->with([
                'error' => $e->getMessage()
            ]);
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
        $data = Bidan::with('user', 'provinsi')->findOrFail($id);
        $provinsi = Ref_Provinsi::all();
        $kota = Ref_Kota::all();

        return view('admin.bidan.edit', compact('data', 'provinsi', 'kota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validate = $request->validate([
            'nama_lengkap' => 'nullable|string',
            'provinsi_id' => 'nullable',
            'kota_id' => 'nullable',
            'status_keanggotaan_ibi' => 'nullable',
            'no_STR' => 'nullable|number',
            'no_SIP' => 'nullable|number',
            'email' => 'nullable|email',
            'password' => 'nullable|min:8'
        ]);

        try{
            $data = Bidan::findOrFail($id);
            $data->update($request->only([
                'provinsi_id', 'kota_id', 'status_keanggotaan_ibi', 'no_STR', 'no_SIP'
            ]));

            $user = User::findOrFail($data->user_id);
            $user->update([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('bidan.index')->with('success','Data berhasil diubah');
        }
        catch(\Exception $e){
            return view('admin.bidan.detail')->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Bidan::findOrFail($id);
        try{
            $data->delete();
            return redirect()->route('bidan.index')->with('success', 'Data berhasil dihapus');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
