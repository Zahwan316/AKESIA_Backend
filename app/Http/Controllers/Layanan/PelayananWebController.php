<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Jenis_layanan;
use App\Models\Pelayanan;
use App\Models\Pelayanan_Form_Item;
use App\Models\Ref_jenis_form;
use Illuminate\Http\Request;

class PelayananWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Pelayanan::with('jenis_layanan')->paginate(10);

        return view('admin.layanan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $jenis_layanan = Jenis_layanan::all();
        $ref_jenis_form = Ref_jenis_form::all();

        return view('admin.layanan.create', compact('jenis_layanan', 'ref_jenis_form'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'jenis_layanan_id' => 'required|exists:jenis_layanans,id',
            'keterangan' => 'required|string',
            'formulir_id' => 'required|string',
        ]);

        try{
            $pelayanan = Pelayanan::create($request->only([
                'nama', 'harga', 'jenis_layanan_id', 'keterangan'
            ]));

            $formulir = Pelayanan_Form_Item::create([
                'pelayanan_id' => $pelayanan->id,
                'form_id' => $request->formulir_id
            ]);

            return redirect()->route('layanan.index')->with('success', 'Data berhasil disimpan');
        }
        catch(\Exception $e){
            return back()->with('error', $e->getMessage());
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
        $pelayanan = Pelayanan::find($id);
        $pelayanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Data berhasil dihapus');
    }
}
