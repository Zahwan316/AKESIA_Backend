<?php

namespace App\Http\Controllers\Bidan;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Bidan;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BidanController extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Bidan::paginate(10);
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
            //'pendidikan_id' => 'required',
            'provinsi_id' => 'required',
            //'jenis_praktik_id' => 'required',
            'kota_id' => 'required',
            'img' => 'required|mimes:png,jpg,jpeg',
            'status_keanggotaan_ibi' => 'required',
            //'nama_tempat_praktik' => 'required',
            'no_STR' => 'required|max:16',
            'no_SIP' => 'required',
            'nama_lengkap' => 'nullable',
            'tempat_bekerja' => 'nullable'
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

            //Update User nama lengkap
            $User = User::findOrFail(auth()->guard()->user()->id);
            $User->nama_lengkap = $request->nama_lengkap;
            $User->save();

            $Bidan = Bidan::create([
                'user_id' => auth()->guard()->user()->id,
                //'pendidikan_id' => $request->pendidikan_id,
                'provinsi_id' => $request->provinsi_id,
                //'jenis_praktik_id' => $request->jenis_praktik_id,
                'kota_id' => $request->kota_id,
                'image_id' => $upload->id,
                'status_keanggotaan_ibi' => $request->status_keanggotaan_ibi,
                //'nama_tempat_praktik' => $request->nama_tempat_praktik,
                'no_STR' => $request->no_STR,
                'no_SIP' => $request->no_SIP,
                'tempat_bekerja' => $request->tempat_bekerja
            ]);

            return $this->apiResponse('Data berhasil disimpan', $Bidan, 201, false);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(), $e->getMessage(), 500, true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Bidan::find($id);

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
            //'pendidikan_id' => 'nullable',
            'provinsi_id' => 'nullable',
            'kota_id' => 'nullable',
            //'jenis_praktik_id' => 'nullable',
            'img' => 'nullable|mimes:png,jpg,jpeg',
            'status_keanggotaan_ibi' => 'nullable',
            //'nama_tempat_praktik' => 'nullable',
            'no_STR' => 'nullable',
            'no_SIP' => 'nullable',
            'nama_lengkap' => 'nullable',
            'tempat_bekerja' => 'nullable'
        ]);

        try{
            $bidan = Bidan::findOrFail($id);

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
                $bidan->image_id = $upload->id;
            }

            //Update User nama lengkap
            if($request->has('user_id')){
                $User = User::findOrFail($request->user_id);
                $User->nama_lengkap = $request->nama_lengkap;
                $User->save();
            }

            $bidan->update($request->only([
                'user_id',
                //'pendidikan_id',
                'provinsi_id',
                'kota_id',
                'image_id',
                'jenis_praktik_id',
                'status_keanggotaan_ibi',
                'nama_tempat_praktik',
                'no_STR',
                'no_SIP',
                'tempat_bekerja',
            ]));


            return $this->apiResponse('Data berhasil diupdate', $bidan, 200, false);
        }
        catch(\Exception $e){
            return $this->apiResponse($e->getMessage(),'', 500, true );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $bidan = Bidan::findOrFail($id);

            // Hapus file gambar jika ada img_id
            if ($bidan->img_id) {
                $upload = Upload::find($bidan->img_id);
                if ($upload && Storage::disk('public')->exists($upload->path)) {
                    Storage::disk('public')->delete($upload->path);
                }

                // Hapus entri upload
                if ($upload) {
                    $upload->delete();
                }
            }

            // Hapus jenis_layanan
            $bidan->delete();

            return $this->apiResponse('Data berhasil dihapus');
        } catch (\Exception $e) {
            return $this->apiResponse('Gagal menghapus data', $e->getMessage(), 500, true);
        }
    }

    public function getCurrBidan(){
        $data = Bidan::with('user')->where("user_id",auth()->guard()->user()->id)->first();
        return response()->json(['Message' => 'Data berhasil diambil', 'data' => $data, 'status_code' => 200, 'error' => false], 200);
    }
}

