<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Disposal;
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

        echo $barang->qty - $barang->qty_disposal;
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
        if ($r->status == 'finish') {
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
        } else {
            $data = [
                'status_perbaikan' => 'crash',
                'keterangan_crash' => $r->keterangan,
            ];
            PerbaikanAsset::where('id', $r->id)->update($data);
            $user = User::where('role', 'manager')->get();
            foreach ($user as $u) {
                $data3 = [
                    'judul' => 'Perbaikan Asset tidak berhasil' . $r->barang_id,
                    'deskripsi' => 'Perbaikan asset karywan tidak berhasil',
                    'link' => 'accperbaikan.index',
                    'user_id' => $u->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-grid-fill',
                    'status' => 'berhasil'
                ];
                Notifikasi::create($data3);
            }
            $barang =  PerbaikanAsset::where('id', $r->id)->first();
            $cabang = Karyawan::where('id', $barang->karyawan_id)->first();
            if ($r->disposal == 'disposal') {
                $data = [
                    'barang_id' => $barang->barang_id,
                    'cabang_id' => $cabang->cabang_id,
                    'karyawan_id' => $barang->karyawan_id,
                    'invoice_peminjaman' => $barang->barang_id,
                    'jumlah' => $barang->jumlah,
                    'keterangan' => $r->keterangan,
                    'from' => 'user',
                    'status' => 'pending',
                    'tgl_disposal' => date('Y-m-d'),

                ];
                Disposal::create($data);
                $data2 = [
                    'qty_disposal' => $barang->jumlah
                ];
                PeminjamanAsset::where('barang_id', $barang->barang_id)->where('karyawan_id', $barang->karyawan_id)->update($data2);
                $user = User::where('role', 'manager')->get();
                foreach ($user as $u) {
                    $data3 = [
                        'judul' => 'Pengajuan disposal asset' . $r->barang_id,
                        'deskripsi' => 'Pengajuan disposal asset karyawan',
                        'link' => 'accdisposal.index',
                        'user_id' => $u->id,
                        'read' => 'unread',
                        'icon' => 'bi bi-grid-fill',
                        'status' => 'berhasil'
                    ];
                    Notifikasi::create($data3);
                }
            }
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

    public function delete($id)
    {
        $peminjaman = PerbaikanAsset::findOrFail($id); // cari dulu sebelum dihapus
        Notifikasi::where('judul', 'Perbaikan ' . $peminjaman->invoice)->delete();

        $peminjaman->delete(); // baru hapus
        return redirect()->route('perbaikan.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function getEdit(Request $r)
    {
        $perbaikan = PerbaikanAsset::where('id', $r->id)->first();
        $karya = Karyawan::where('id', $perbaikan->karyawan_id)->first();
        $peminjaman = PeminjamanAsset::where('karyawan_id', $karya->id)
            ->whereRaw('qty - qty_disposal > 0')
            ->orderBy('id', 'desc')
            ->get();



        $stok =  PeminjamanAsset::where('karyawan_id', $karya->id)
            ->where('barang_id', $perbaikan->barang_id)
            ->first();
        $data = [
            'perbaikan' => $perbaikan,
            'karyawan' => Karyawan::where('cabang_id', Auth::user()->cabang_id)->get(),
            'vendor' => Vendor::all(),
            'barang' => Barang::getBarang(Auth::user()->cabang_id),
            'peminjaman' => $peminjaman,
            'stok' => $stok,
        ];
        return view('pengajuan-perbaikan.getEdit', $data);
    }

    public function update(Request $r)
    {
        // if ($r->from == 'user') {
        $barang =  PeminjamanAsset::where('invoice', $r->barang_id)->first();
        PerbaikanAsset::where('id', $r->id)->delete();
        Notifikasi::where('judul', 'Perbaikan Asset ' . $r->barang_id)->delete();

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


        return redirect()->route('perbaikan.index')->with('success', 'Data Berhasil Disimpan');
    }
}
