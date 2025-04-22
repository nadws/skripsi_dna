<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Karyawan;
use App\Models\Notifikasi;
use App\Models\PeminjamanAsset;
use App\Models\PerbaikanAsset;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerbaikanAssetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengajuan perbaikan',
            'perbaikan' => PerbaikanAsset::where('cabang_id', Auth::user()->cabang_id)->orderBy('id', 'desc')->get(),
            'karyawan' => Karyawan::where('cabang_id', Auth::user()->cabang_id)->get(),
            'vendor' => Vendor::all(),
            'barang' => Barang::getBarang(Auth::user()->cabang_id)

        ];
        return view('pengajuan-perbaikan.index', $data);
    }

    public function getAssetKaryawan(Request $r)
    {
        $barang = PeminjamanAsset::where('karyawan_id', $r->karyawan_id)
            ->whereRaw('qty - qty_disposal > 0')
            ->orderBy('id', 'desc')
            ->get();

        echo "<option value=''>-Pilih Asset-</option>";
        foreach ($barang as $b) {
            $nama_barang = $b->barang->nama_barang . ' Merk :' . $b->barang->merek . ' Kode Peminjaman :' . $b->invoice;
            echo "<option value='$b->invoice'>$nama_barang</option>";
        }
    }

    public function getQtyAssetKaryawan(Request $r)
    {
        $barang =  PeminjamanAsset::where('invoice', $r->invoice)->first();

        echo $barang->qty;
    }
    public function getStockCabang(Request $r)
    {
        $barang =  Barang::getBarangOne($r->barang_id, Auth::user()->cabang_id);

        echo $barang->stok;
    }
    public function getPerbaikan(Request $r)
    {
        $data = [
            'p' => PerbaikanAsset::where('id', $r->id)->first()
        ];
        return view('pengajuan-perbaikan.selesai', $data);
    }

    public function selesai(Request $r)
    {
        $data = [
            'biaya' => $r->biaya,
            'status_perbaikan' => 'finish'
        ];
        PerbaikanAsset::where('id', $r->id)->update($data);
        $user = User::where('role', 'manager')->get();
        foreach ($user as $u) {
            $data3 = [
                'judul' => 'Perbaikan Asset selesai' . $r->barang_id,
                'deskripsi' => 'Perbaikan asset karywan selesai',
                'link' => 'accperbaikan.index',
                'user_id' => $u->id,
                'read' => 'unread',
                'icon' => 'bi bi-grid-fill',
                'status' => 'berhasil'
            ];
            Notifikasi::create($data3);
        }
        return redirect()->route('perbaikan.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function store(Request $r)
    {
        // if ($r->from == 'user') {
        $barang =  PeminjamanAsset::where('invoice', $r->barang_id)->first();
        $data = [
            'barang_id' => $barang->barang_id,
            'cabang_id' => Auth::user()->cabang_id,
            'vendor_id' => $r->vendor_id,
            'karyawan_id' => $r->karyawan_id,
            'jumlah' => $r->jumlah,
            'biaya' => $r->biaya,
            'keterangan' => $r->keterangan,
            'from' => 'user',
            'status' => 'pending',
            'tgl_perbaikan' => date('Y-m-d'),
            'tgl_estimasi' => $r->tgl_estimasi,
        ];
        PerbaikanAsset::create($data);
        $user = User::where('role', 'manager')->get();
        foreach ($user as $u) {
            $data3 = [
                'judul' => 'Perbaikan Asset ' . $r->barang_id,
                'deskripsi' => 'Perbaikan asset karywan',
                'link' => 'accperbaikan.index',
                'user_id' => $u->id,
                'read' => 'unread',
                'icon' => 'bi bi-grid-fill',
                'status' => 'berhasil'
            ];
            Notifikasi::create($data3);
        }
        // } else {
        //     $data = [
        //         'barang_id' => $r->barang_id,
        //         'cabang_id' => Auth::user()->cabang_id,
        //         'vendor_id' => $r->vendor_id,
        //         'karyawan_id' => 0,
        //         'jumlah' => $r->jumlah,
        //         'biaya' => $r->biaya,
        //         'keterangan' => $r->keterangan,
        //         'from' => $r->from,
        //         'status' => 'pending',
        //         'tgl_perbaikan' => date('Y-m-d'),
        //         'tgl_estimasi' => $r->tgl_estimasi,
        //     ];
        //     PerbaikanAsset::create($data);
        // }

        return redirect()->route('perbaikan.index')->with('success', 'Data Berhasil Disimpan');
    }
}
