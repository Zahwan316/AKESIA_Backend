<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Jenis_layanan;
use Illuminate\Http\Request;
use App\Models\Pelayanan;
use App\Models\Pelayanan_Form_Item;
use App\Models\RefJenisForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ImportLayananWebController extends Controller
{
    //
    public function importForm()
    {
        return view('admin.import.layanan'); // buat view form upload
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data); // hapus header baris pertama

        DB::beginTransaction();

        try {
            foreach ($data as $row) {
                $searchTerm = trim($row[1]);

                $jenis_layanan = Jenis_layanan::where('nama', 'like', '%'.$searchTerm.'%')->first();
                // Ubah index sesuai urutan kolom CSV
                $namaLayanan = $row[3];
                $jenisLayananId = $jenis_layanan->id; // Pastikan ini ID jenis layanan
                $harga = strtolower(trim($row[4])) === 'chat admin' ? 0 : (int) $row[4];
                $keterangan = $row[5];
                $formulir = explode(',', $row[2]); // Misalnya berisi "2,3,4,5"

                // Simpan ke tabel pelayanan
                $pelayanan = Pelayanan::create([
                    'nama' => $namaLayanan,
                    'jenis_layanan_id' => $jenisLayananId,
                    'harga' => $harga,
                    'keterangan' => $keterangan,
                ]);

                // Simpan relasi ke pelayanan_form_item
                foreach ($formulir as $form_id) {
                    if (is_numeric(trim($form_id))) {
                        Pelayanan_Form_Item::create([
                            'pelayanan_id' => $pelayanan->id,
                            'form_id' => trim($form_id)
                        ]);
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'Data berhasil diimpor');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal impor: ' . $e->getMessage());
        }
    }
}
