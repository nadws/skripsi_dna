<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index()
    {
        $peminjaman = DB::table('peminjaman_assets')
            ->selectRaw('DATE_FORMAT(tgl_pinjam, "%Y-%m") as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        $stok = DB::table('stoks')
            ->select('barang_id', DB::raw('SUM(debit) - SUM(kredit) as stok'))
            ->groupBy('barang_id')
            ->get();

        $perbaikan = DB::table('perbaikan_assets')
            ->selectRaw('DATE_FORMAT(tgl_perbaikan, "%Y-%m") as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        $disposal = DB::table('disposals')
            ->selectRaw('DATE_FORMAT(tgl_disposal, "%Y-%m") as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Tambahkan nama barang (jika tabel barang ada)
        foreach ($stok as $item) {
            $item->nama_barang = DB::table('barangs')
                ->where('id', $item->barang_id)
                ->value('nama_barang'); // ganti dengan kolom nama di tabel barang
        }

        return view('dashboard', compact('peminjaman', 'stok', 'perbaikan', 'disposal'));
    }
}
