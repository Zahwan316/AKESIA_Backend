<?php

namespace App\Http\Controllers\Layanan;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Pelayanan_Form_Item;
use Illuminate\Http\Request;

class PelayananFormItemController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = $request->query('pelayanan_id');
        if($query){
            $data = Pelayanan_Form_Item::where('pelayanan_id', $query)->with('form', 'pelayanan')->get();
        }
        else{
            $data = Pelayanan_Form_Item::with('form', 'pelayanan')->get();
        }

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
            'form_id' => 'required',
            'pelayanan_id' => 'required'
        ]);

        try{
            $data = Pelayanan_Form_Item::create($request->only(['form_id', 'pelayanan_id']));

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
