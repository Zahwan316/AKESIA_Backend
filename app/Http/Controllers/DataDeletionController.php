<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DataDeletionRequest;
use App\Models\DataDeletionRequest as ModelsDataDeletionRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DataDeletionController extends Controller
{
    /**
     * Menampilkan form permintaan penghapusan data
     */
    public function showForm()
    {
        return view('data-deletion-request');
    }

    /**
     * Memproses permintaan penghapusan data
     */
    public function submitRequest(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'confirmation' => 'required|accepted'
        ], [
            'confirmation.required' => 'Anda harus menyetujui bahwa penghapusan data bersifat permanen.',
            'confirmation.accepted' => 'Anda harus menyetujui bahwa penghapusan data bersifat permanen.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $findUser = User::where('email', $request->email)->first();

            if(!$findUser){
                return redirect()->back()->with('error', 'Email tidak ditemukan di aplikasi kami');
            }

            // Buat token unik
            $token = Str::random(60);

            // Simpan permintaan ke database
            $deletionRequest = ModelsDataDeletionRequest::create([
                'user_id' => $findUser->id,
                'email' => $request->email,
                'reason' => $request->reason,
                'token' => $token,
            ]);

            // Kirim email verifikasi
            $verificationUrl = route('data-deletion.verify', ['token' => $token]);
            Mail::to($request->email)->send(new DataDeletionRequest([
                'email' => $request->email,
                'verification_url' => $verificationUrl,
                'reason' => $request->reason
            ]));

            return redirect()->back()->with('success', 'Permintaan penghapusan data telah diterima. Kami telah mengirimkan email verifikasi ke alamat email Anda.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }

    }

    public function verifyRequest($token)
    {
        $deletionRequest = ModelsDataDeletionRequest::where('token', $token)
            ->where('is_verified', false)
            ->firstOrFail();

        return view('data-deletion-verify', [
            'request' => $deletionRequest
        ]);
    }

    public function processDeletion(Request $request)
    {
        $deletionRequest = ModelsDataDeletionRequest::where('token', $request->token)
            ->where('is_verified', false)
            ->firstOrFail();

        // Verifikasi permintaan
        $deletionRequest->update([
            'is_verified' => true,
            'verified_at' => now()
        ]);

        // Hapus data user
        $user = $deletionRequest->user;

        // Lakukan soft delete jika menggunakan SoftDeletes
        $user->delete();

        // Atau hapus permanen jika diperlukan
        // $user->forceDelete();

        // Hapus semua data terkait jika diperlukan
        // $user->relatedData()->delete();

        return view('data-deletion-complete');
    }
}
