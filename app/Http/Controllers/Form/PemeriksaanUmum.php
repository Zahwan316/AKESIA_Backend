<?php

namespace App\Http\Controllers\Form;

use App\apiResponse;
use App\Http\Controllers\Controller;
use App\Models\Form_pemeriksaan_umum;
use App\Models\Notifications;
use App\Models\Pemeriksaan;
use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Exception\Messaging\InvalidArgument;
use Kreait\Firebase\Exception\Messaging\NotFound;

class PemeriksaanUmum extends Controller
{
    use apiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Form_pemeriksaan_umum::all();

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
            'bentuk_tubuh' => 'required',
            'kesadaran_id' => 'required',
            'mata' => 'required',
            'leher' => 'required',
            'payudara' => 'required',
            'paru' => 'required',
            'jantung' => 'required',
            'hati' => 'required',
            'suhu_badan' => 'required',
            'genetalia' => 'required',
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|numeric',
            'pemeriksaan_id' => 'required',
            'tanggal_kontrol_kembali' => 'nullable',
            'user_id' => 'required',
            'soap' => 'nullable'
        ]);

        try{
            $notif = Notifications::create([
                'user_id' => $request->user_id,
                'title' => 'Haloo mak',
                'message' => 'Kontrol lagi yuk di tanggal '. $request->tanggal_kontrol_kembali,
            ]);

            //handle send notification to mobile
            Carbon::setLocale('id');
            $tanggal = Carbon::parse($request->tanggal_kontrol_kembali)->translatedFormat('l, d F Y');

            $user = User::findOrFail($request->user_id);
            if ($user->fcm_token) {
                $messaging = (new Factory)
                    ->withServiceAccount(storage_path('app/firebase/firebase-credentials.json'))
                    ->createMessaging();

                $message = CloudMessage::withTarget('token', $user->fcm_token)
                    ->withNotification(Notification::create(
                        'Kontrol Kembali yuk!',
                        'Ibu, mohon kontrol kembali pada tanggal '.$tanggal
                    ));

                $messaging->send($message);
            }

            $data = Form_pemeriksaan_umum::create($request->only([
                'bentuk_tubuh',
                'kesadaran_id',
                'mata',
                'leher',
                'payudara',
                'paru',
                'jantung',
                'hati',
                'suhu_badan',
                'genetalia',
                'tinggi_badan',
                'berat_badan',
                'pemeriksaan_id',
                'tanggal_kontrol_kembali',
                'soap'
            ]));

            return $this->apiResponse('Data berhasil dibuat', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse( $e->getMessage(), '', 500 ,true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Form_pemeriksaan_umum::find($id);
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
            'bentuk_tubuh' => 'required',
            'kesadaran_id' => 'required',
            'mata' => 'required',
            'leher' => 'required',
            'payudara' => 'required',
            'paru' => 'required',
            'jantung' => 'required',
            'hati' => 'required',
            'suhu_badan' => 'required',
            'genetalia' => 'required',
            'tinggi_badan' => 'required|integer',
            'berat_badan' => 'required|numeric',
            'pemeriksaan_id' => 'required',
            'tanggal_kontrol_kembali' => 'nullable',
            'soap' => 'nullable'
        ]);

        try{
            $notif = Notifications::create([
                'user_id' => $request->user_id,
                'title' => 'Haloo mak',
                'message' => 'Kontrol lagi yuk di tanggal '. $request->tanggal_kontrol_kembali,
            ]);

            //handle send notification to mobile
            Carbon::setLocale('id');
            $tanggal = Carbon::parse($request->tanggal_kontrol_kembali)->translatedFormat('l, d F Y');

            $user = User::findOrFail($request->user_id);


            try{
                if ($user->fcm_token) {
                    $messaging = (new Factory)
                        ->withServiceAccount(storage_path('app/firebase/firebase-credentials.json'))
                        ->createMessaging();

                    $message = CloudMessage::withTarget('token', $user->fcm_token)
                        ->withNotification(Notification::create(
                            'Kontrol Kembali yuk!',
                            'Ibu, mohon kontrol kembali pada tanggal '.$tanggal
                        ));

                    $messaging->send($message);
                }
            }
            catch (NotFound  | InvalidArgument $e) {
                // Token tidak valid → hapus dari database
                $user->update(['fcm_token' => null]);

                Log::warning("FCM token invalid, telah dihapus untuk user ID: {$user->id}");
            } catch (\Exception $e) {
                Log::error("Gagal kirim notifikasi: " . $e->getMessage());
            }

            $data = Form_pemeriksaan_umum::find($id);
            $data->update($request->only([
                'bentuk_tubuh',
                'kesadaran_id',
                'mata',
                'leher',
                'payudara',
                'paru',
                'jantung',
                'hati',
                'suhu_badan',
                'genetalia',
                'tinggi_badan',
                'berat_badan',
                'pemeriksaan_id',
                'tanggal_kontrol_kembali',
                'soap'
            ]));

            return $this->apiResponse('Data berhasil diubah', $data);
        }
        catch(\Exception $e){
            return $this->apiResponse( $e->getMessage(), '', 500 ,true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showFormByPendaftaran(string $id){
        $existing = Form_pemeriksaan_umum::where('pemeriksaan_id', $id)->first();

        if ($existing) {
            // Jika ada, kirim datanya agar form terisi otomatis
            return $this->apiResponse('Data ditemukan dan akan digunakan untuk mengisi form', $existing);
        } else {
            $currentPemeriksaan = Pemeriksaan::find($id);
            if (!$currentPemeriksaan) {
                return $this->apiResponse('Pemeriksaan tidak ditemukan', null, 404);
            }
            // Ambil latest form dari ibu yang sama
            $latest = Form_pemeriksaan_umum::whereHas('pemeriksaan', function ($query) use ($currentPemeriksaan) {
                $query->where('ibu_id', $currentPemeriksaan->ibu_id);
            })->latest()->first();

            if ($latest) {
                return $this->apiResponse('Form baru, mengisi dengan data terakhir dari ibu yang sama', $latest);
            }
            // Kalau ibu belum pernah isi form, prefill kosong
            $prefill = [
                'pemeriksaan_id' => $currentPemeriksaan->id,
                'bentuk_tubuh' => null,
                'kesadaran_id' => null,
                'mata' => null,
                'leher' => null,
                'payudara' => null,
                'paru' => null,
                'jantung' => null,
                'hati' => null,
                'suhu_badan' => null,
                'genetalia' => null,
                'tinggi_badan' => null,
                'berat_badan' => null,
                'tanggal_kontrol_kembali' => null,
                'soap' => null,
            ];
            return $this->apiResponse('Belum ada data, form akan kosong', null);
        }
    }
}
