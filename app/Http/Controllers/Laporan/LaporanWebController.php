<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = $request->query('tanggal');
        if($query){
            $data = Laporan::with('pemeriksaan', 'ibu')->whereDate('created_at', $query)->paginate(4);
        }
        else{
            $data = Laporan::with('pemeriksaan','ibu')->orderBy('created_at','desc')->paginate(4);
        }

        return view('admin.laporan.index', compact('data'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Laporan::with(
            'pemeriksaan.pelayanan.jenis_layanan',
            'pemeriksaan.bidan.user',
            'pemeriksaan.pendaftaran',
            'pemeriksaan.form_pelayanan_bayi.tambahan_layanan',
            'pemeriksaan.form_pemeriksaan_umum',
            'ibu',
            'bayi'
        )
        ->find($id);

        $formRelations = [
            'form_pelayanan_bayi.tambahan_layanan',
            'form_pemeriksaan_umum',
            // tambahkan semua relasi form di sini
        ];

        return view('admin.laporan.edit', compact('data', 'formRelations'));
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
