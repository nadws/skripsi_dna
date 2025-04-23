<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Disposal;
use App\Models\Karyawan;
use App\Models\Notifikasi;
use App\Models\PeminjamanAsset;
use App\Models\Stok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccDisposalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Disposal Asset',
            'disposal' => Disposal::orderBy('id', 'desc')->get(),
        ];
        return view('accdisposal.index', $data);
    }
    public function getDisposal(Request $r)
    {
        $data = [
            'p' => Disposal::where('id', $r->id)->first()
        ];
        return view('accdisposal.accdisposal', $data);
    }
    public function edit(Request $r)
    {
        $data = [
            'status' => $r->status,
            'ket_presiden' => $r->ket_presiden
        ];
        Disposal::where('id', $r->id)->update($data);

        $disposal = Disposal::where('id', $r->id)->first();
        if ($r->status == 'approved') {
            if ($disposal->from == 'cabang') {
                $data2 = [
                    'barang_id' => $disposal->barang_id,
                    'debit' => 0,
                    'kredit' => $disposal->jumlah,
                    'ket' => 'Disposal INV-' . $disposal->id,
                    'cabang_id' => $disposal->cabang_id,
                    'harga' => 0,
                    'tanggal' => date('Y-m-d')
                ];
                Stok::create($data2);
            } else {
                $data2 = [
                    'qty_disposal' => $disposal->jumlah
                ];
                PeminjamanAsset::where('invoice', $disposal->invoice_peminjaman)->update($data2);
            }
            $user = User::where('cabang_id', $disposal->cabang_id)->get();
            foreach ($user as $u) {
                $data3 = [
                    'judul' => 'Disposal asset disetujui ' . $disposal->barang->nama_barang,
                    'deskripsi' => 'Disposal asset disetujui',
                    'link' => 'disposal.index',
                    'user_id' => $u->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-trash',
                    'status' => 'berhasil'
                ];
                Notifikasi::create($data3);
            }
        } else {
            $user = User::where('cabang_id', $disposal->cabang_id)->get();
            foreach ($user as $u) {
                $data3 = [
                    'judul' => 'Disposal asset ditolak ' . $disposal->barang->nama_barang,
                    'deskripsi' => 'Disposal asset ditolak',
                    'link' => 'disposal.index',
                    'user_id' => $u->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-trash',
                    'status' => 'gagal'
                ];
                Notifikasi::create($data3);
            }
        }
        return redirect()->route('accdisposal.index')->with('success', 'Data Berhasil Disimpan');
    }
}
