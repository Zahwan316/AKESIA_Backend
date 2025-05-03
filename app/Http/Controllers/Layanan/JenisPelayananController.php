<?php

namespace App\Http\Controllers\Layanan;

use App\apiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jenis_layanan;
use App\Models\Upload;
use PHPUnit\Event\Test\DataProviderMethodFinishedSubscriber;
use Illuminate\Support\Facades\Storage;

class JenisPelayananController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jenis_layanan = Jenis_layanan::all();

        return $this->apiResponse('Data berhasil diambil', $jenis_layanan);
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
            'nama'=> 'required',
            'img' => 'required|mimes:png,jpg,jpeg',
            'keterangan' => 'required',
            ///'user_id' => 'required',
        ]);

        try{
            // 1. Simpan file gambar ke storage
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('uploads', 'public'); // disimpan di storage/app/public/uploads

                // 2. Simpan ke tabel uploads
                $upload = Upload::create([
                    'path' => 'storage/' . $path, // jika ingin bisa diakses langsung lewat URL
                    'user_id' => auth()->guard()->user()->id,    // atau sesuai kebutuhan kamu
                ]);
            } else {
                return $this->apiResponse('Gambar tidak ditemukan', null, 400, true);
            }

            // 3. Simpan ke tabel jenis_layanan
            $Jenis_layanan = Jenis_layanan::create([
                'nama' => $request->nama,
                'img_id' => $upload->id,
                'keterangan' => $request->keterangan,
            ]);

            return $this->apiResponse('Data berhasil disimpan', $Jenis_layanan);
        }
        catch(\Exception $e){
            return $this->apiResponse('Gagal menyimpan data', $e->getMessage(), 500, true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Jenis_layanan::find($id);
        return $this->apiResponse('Data berhasil diambil', $data,);
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
        $validate = $request->validate([
            'nama'=> 'nullable|string',
            'harga' => 'nullable',
            'kuantitas' => 'nullable',
            'keterangan' => 'nullable',
            'img' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // validasi gambar opsional
        ]);

        try {
            $jenisLayanan = Jenis_layanan::findOrFail($id);

            // Update gambar jika ada
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads', $filename, 'public');

                // Buat entri upload baru
                $upload = Upload::create([
                    'path' => $path,
                    'user_id' => auth()->guard()->id(), // atau sesuaikan dengan user_id dari request
                ]);

                // Update img_id
                $jenisLayanan->img_id = $upload->id;
            }

            // Update field lain
            $jenisLayanan->fill($request->only([
                'nama', 'harga', 'kuantitas', 'keterangan'
            ]));

            $jenisLayanan->save();

            return $this->apiResponse('Data berhasil disimpan', $jenisLayanan);

        } catch (\Exception $e) {
            return $this->apiResponse('Gagal menyimpan data', $e->getMessage(), 500, true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $jenisLayanan = Jenis_layanan::findOrFail($id);

            // Hapus file gambar jika ada img_id
            if ($jenisLayanan->img_id) {
                $upload = Upload::find($jenisLayanan->img_id);
                if ($upload && Storage::disk('public')->exists($upload->path)) {
                    Storage::disk('public')->delete($upload->path);
                }

                // Hapus entri upload
                if ($upload) {
                    $upload->delete();
                }
            }

            // Hapus jenis_layanan
            $jenisLayanan->delete();

            return $this->apiResponse('Data berhasil dihapus');
        } catch (\Exception $e) {
            return $this->apiResponse('Gagal menghapus data', $e->getMessage(), 500, true);
        }
    }
}
