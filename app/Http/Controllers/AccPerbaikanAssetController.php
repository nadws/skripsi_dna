<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Disposal;
use App\Models\Karyawan;
use App\Models\Notifikasi;
use App\Models\PeminjamanAsset;
use App\Models\PerbaikanAsset;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class AccPerbaikanAssetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengajuan perbaikan',
            'perbaikan' => PerbaikanAsset::orderBy('id', 'desc')->get(),
            'karyawan' => Karyawan::where('cabang_id', Auth::user()->cabang_id)->get(),
            'vendor' => Vendor::all(),
            'barang' => Barang::getBarang(Auth::user()->cabang_id)

        ];
        return view('acc-pengajuan-perbaikan.index', $data);
    }

    public function getPerbaikan(Request $r)
    {
        $data = [
            'p' => PerbaikanAsset::where('id', $r->id)->first()
        ];
        return view('acc-pengajuan-perbaikan.accperbaikan', $data);
    }
    public function edit(Request $r)
    {
        $data = [
            'status' => $r->status,
            'ket_presiden' => $r->ket_presiden,
            'status_perbaikan' => $r->status == 'approved' ? 'repair' : ($r->disposal == 'disposal' ? 'crash' : 'finish'),
            'keterangan_crash' => $r->status == 'approved' ? '' : $r->ket_presiden
        ];
        PerbaikanAsset::where('id', $r->id)->update($data);

        $barang =  PerbaikanAsset::where('id', $r->id)->first();
        $cabang = Karyawan::where('id', $barang->karyawan_id)->first();
        if ($r->status == 'approved') {
            $user = User::where('cabang_id', $cabang->cabang_id)->get();
            foreach ($user as $u) {
                $data3 = [
                    'judul' => 'Perbaikan asset ' . $barang->barang_id,
                    'deskripsi' => 'Perbaikan asset disetujui',
                    'link' => 'perbaikan.index',
                    'user_id' => $u->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-journal-bookmark',
                    'status' => 'berhasil'
                ];
                Notifikasi::create($data3);
            }
        } else {
            $user = User::where('cabang_id', $cabang->cabang_id)->get();
            foreach ($user as $u) {
                $data3 = [
                    'judul' => 'Perbaikan asset ' . $barang->barang_id,
                    'deskripsi' => 'Perbaikan asset ditolak',
                    'link' => 'perbaikan.index',
                    'user_id' => $u->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-journal-bookmark',
                    'status' => 'gagal'
                ];
                Notifikasi::create($data3);
            }
        }

        if ($r->disposal == 'disposal') {

            $data = [
                'barang_id' => $barang->barang_id,
                'cabang_id' => $cabang->cabang_id,
                'karyawan_id' => $barang->karyawan_id,
                'invoice_peminjaman' => $barang->barang_id,
                'jumlah' => $barang->jumlah,
                'keterangan' => $r->ket_presiden,
                'from' => 'user',
                'status' => 'approved',
                'tgl_disposal' => date('Y-m-d'),
                'ket_presiden' => $r->ket_presiden
            ];
            Disposal::create($data);
            $data2 = [
                'qty_disposal' => $barang->jumlah
            ];
            PeminjamanAsset::where('barang_id', $barang->barang_id)->where('karyawan_id', $barang->karyawan_id)->update($data2);
        }
        return redirect()->route('accperbaikan.index')->with('success', 'Data Berhasil Disimpan');
    }
}
