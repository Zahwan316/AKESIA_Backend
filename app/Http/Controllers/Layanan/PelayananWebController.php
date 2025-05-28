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
        $data = Pelayanan::with('jenis_layanan', 'formItems.form')->paginate(10);
        $pelayanan_form_item = Pelayanan_Form_Item::with( 'form')->paginate(10)->groupBy('pelayanan_id');

        return view('admin.layanan.index', compact('data', 'pelayanan_form_item'));
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
            'harga' => 'nullable|integer',
            'jenis_layanan_id' => 'required|exists:jenis_layanans,id',
            'keterangan' => 'required|string',
            'formulir_id' => 'nullable|string',
        ]);

        try{
            $pelayanan = Pelayanan::create($request->only([
                'nama', 'harga', 'jenis_layanan_id', 'keterangan'
            ]));

            if($request->harga_admin != null){
                $pelayanan->harga = 0;
                $pelayanan->save();
            }
            else if($request->harga == ''){
                $pelayanan->harga = 0;
                $pelayanan->save();
            }
            else{
                $pelayanan->harga = $request->harga;
                $pelayanan->save();
            }

            $pelayanan->update($request->only([
                'nama', 'harga', 'jenis_layanan_id', 'keterangan'
            ]));

            if($request->formulir_id === 'formulir_periksa_hamil'){
                $form_id = [2,3,4,5];
            }
            else if($request->formulir_id){
                $form_id = [$request->formulir_id];
            }
            else{
                $form_id = [];
            }

            foreach($form_id as $formid){
                $formulir = Pelayanan_Form_Item::create([
                    'pelayanan_id' => $pelayanan->id,
                    'form_id' => $formid
                ]);

            }


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
        $data = Pelayanan::find($id);
        $jenis_layanan = Jenis_layanan::all();
        $ref_jenis_form = Ref_jenis_form::all();

        $selectedFormIds = $data->formItems->pluck('form_id')->toArray();
        $gabunganFormIds = [2, 3, 4, 5];
        $isMultiple = collect($gabunganFormIds)->diff($selectedFormIds)->isEmpty();
        $selected_formulir = $isMultiple ? 'multiple' : ($selectedFormIds[0] ?? null);


        return view('admin.layanan.edit', compact('data', 'jenis_layanan', 'ref_jenis_form', 'selected_formulir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //
        $validate = $request->validate([
            'nama' => 'nullable|string',
            'harga' => 'nullable|integer',
            'jenis_layanan_id' => 'nullable|exists:jenis_layanans,id',
            'keterangan' => 'nullable|string',
            'formulir_id' => 'nullable|string',
        ]);

        try{
            $pelayanan = Pelayanan::findOrFail($id);
            if($request->harga_admin != null){
                $pelayanan->harga = 0;
                $pelayanan->save();
            }
            else{
                $pelayanan->harga = $request->harga;
                $pelayanan->save();
            }

            $pelayanan->update($request->only([
                'nama', 'harga', 'jenis_layanan_id', 'keterangan'
            ]));

            Pelayanan_Form_Item::where('pelayanan_id', $pelayanan->id)->delete();

            if($request->formulir_id === 'formulir_periksa_hamil'){
                $form_id = [2,3,4,5];
            }
            else if($request->formulir_id){
                $form_id = [$request->formulir_id];
            }
            else{
                $form_id = [];
            }

            foreach($form_id as $formid){
                $formulir = Pelayanan_Form_Item::create([
                    'pelayanan_id' => $pelayanan->id,
                    'form_id' => $formid
                ]);

            }


            return redirect()->route('layanan.index')->with('success', 'Data berhasil disimpan');
        }
        catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
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
