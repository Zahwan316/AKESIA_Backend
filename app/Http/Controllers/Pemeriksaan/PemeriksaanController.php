<?php

namespace App\Http\Controllers\Pemeriksaan;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Pelayanan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PemeriksaanController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = $request->query('tanggal');

        if($query){
            //$tanggal = Carbon::createFromFormat('d/m/Y', $query)->format('Y-m-d');
            $data = Pemeriksaan::with('pelayanan.jenis_layanan', 'bayi', 'ibu.user', 'pendaftaran.bayi')
            ->whereDate('tanggal_kunjungan', $query)
            ->orderBy('created_at', 'desc')
            ->get();
        }
        else
        {
            $data= Pemeriksaan::with('pelayanan.jenis_layanan', 'bayi', 'ibu.user', 'pendaftaran')
            ->orderBy('created_at', 'desc')
            ->get();
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
        $validate = request()->validate([
            'bidan_id' => 'required|integer|exists:bidans,id',
            'ibu_id' => 'required|integer|exists:ibus,id',
            'pelayanan_id' => 'required|integer|exists:pelayanans,id',
            'pendaftaran_id' => 'required|integer|exists:pendaftarans,id',
            'harga' => 'required|integer|min:1',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required|date_format:H:i'
        ]);

        try{
            $data = Pemeriksaan::create($request->only([
                'bidan_id',
                'ibu_id',
                'pelayanan_id',
                'pendaftaran_id',
                'harga',
                'tanggal_kunjungan',
                'jam_kunjungan',
            ]));

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
        $data = Pemeriksaan::with(['pelayanan', 'ibu.user', 'pendaftaran', 'bayi'])->find($id);
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
        $validate = request()->validate([
            'bidan_id' => 'nullable|integer|exists:bidans,id',
            'ibu_id' => 'nullable|integer|exists:ibus,id',
            'pelayanan_id' => 'nullable|integer|exists:pelayanans,id',
            'pendaftaran_id' => 'nullable|integer|exists:pendaftarans,id',
            'harga' => 'nullable|integer|min:1',
            'tanggal_kunjungan' => 'nullable|date',
            'jam_kunjungan' => 'nullable|date_format:H:i'
        ]);

        try{
            $data = Pemeriksaan::with('pendaftaran')->find($id);
            $data->update($request->only([
                'bidan_id',
                'ibu_id',
                'pelayanan_id',
                'pendaftaran_id',
                'harga',
                'tanggal_kunjungan',
                'jam_kunjungan',
            ]));

            //set harga dengan data baru
            $data->load('pelayanan');
            $data->harga = $data->pelayanan->harga;


            //cek umur
            function hitungUmur($tanggalLahir)
            {
                return Carbon::parse($tanggalLahir)->age;
            }

            //fungsi untuk menentukan harga tambahan
            if($request->pelayanan != null && $request->tanggal_lahir_bayi_pemeriksaan != null){
                $pelayanan = Pelayanan::where('nama', 'LIKE' , '%' . $request->pelayanan['nama'] . '%')->first();
                $umur = hitungUmur($request->tanggal_lahir_bayi_pemeriksaan);
                if(Str::contains($pelayanan->nama, 'Healthy Massage')){
                    if($umur === 4 || $umur === 5){
                        $data->harga = $pelayanan->harga + 10000;
                    }
                    else if($umur > 5){
                        $data->harga = $pelayanan->harga + 20000;
                    }
                }
                else if(Str::contains($pelayanan->nama, 'Paket Bapil Singgle')){
                    if($umur > 2){
                        $data->harga = $pelayanan->harga + 10000;
                    }
                }
                else if(Str::contains($pelayanan->nama, 'Bapil Premium')){
                    if($umur > 2 && $umur <= 4){
                        $data->harga = $pelayanan->harga + 10000;
                    }
                    else if($umur > 4){
                        $data->harga = $pelayanan->harga + 20000;
                    }
                }
                //dd($pelayanan);
            }
            $data->save();

            $totalKunjungan = Pemeriksaan::where('ibu_id', $data->ibu_id)->count();

            $PenentuKunjunganPasienLama = 8;

            if($totalKunjungan >= $PenentuKunjunganPasienLama){
                $jenisPasien = 'Lama';
            }
            else{
                $jenisPasien = 'Baru';
            }


            $laporan = Laporan::where('pemeriksaan_id', $id)->first();

            if (!$laporan) {
                $laporan = Laporan::create([
                    'pemeriksaan_id' => $id,
                    'ibu_id' => $data->ibu_id,
                    'bayi_id' => $data->pendaftaran->bayi_id,
                    'jenis_pasien' => $jenisPasien,
                    'total_kunjungan' => $totalKunjungan
                ]);
            }

            return $this->apiResponse('Data berhasil diubah', $data);

        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), '', 500, true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try{
            $data = Pemeriksaan::find($id);

            $data->delete();
            return $this->apiResponse('Data berhasil dihapus');
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), '',500,);
        }

    }
}
