<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index(){

        $bulanIni = Carbon::now()->format('Y-m'); // Contoh: '2025-05'

        $kunjunganHarian = DB::table('laporans')
            ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->where('created_at', 'like', $bulanIni . '%')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal')
            ->get();

        // Buat array untuk label (tanggal) dan data (jumlah)
        $labels = $kunjunganHarian->pluck('tanggal');
        $data = $kunjunganHarian->pluck('total');

        return view('admin.dashboard', compact('labels', 'data'));
    }
}
