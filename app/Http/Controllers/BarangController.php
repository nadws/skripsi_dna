<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use App\Models\Disposal;
use App\Models\Stok;
use App\Models\KategoriAsset;
use App\Models\PembelianBarang;
use App\Models\PeminjamanAsset;
use App\Models\PerbaikanAsset;
use App\Models\PermintaanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'presiden' || Auth::user()->role == 'superadmin') {
            $cabang_id = 0;
        } else {
            $cabang_id = Auth::user()->cabang_id;
        }
        $kode_barang = Barang::latest('kode')->first();
        $kode_barang = empty($kode_barang) ? 1001 : $kode_barang->kode  + 1;

        $data = [
            'title' => 'Daftar Barang',
            'barang' =>  Barang::getBarang($cabang_id),
            'role' => Auth::user()->role,
            'kode_barang' => $kode_barang,
            'cabang_id' => $cabang_id,
            'nama_cabang' => Auth::user()->role == 'admin' ? Cabang::find($cabang_id)->nama  : 'Semua Cabang',
            'cabang' => Cabang::all(),
            'kategori' => KategoriAsset::all(),


        ];
        return view('barang.index', $data);
    }

    public function store(Request $r)
    {
        try {

            $kode_barang = Barang::latest('kode')->first();
            $kode_barang = empty($kode_barang) ? 1001 : $kode_barang->kode + 1;

            $imageName = null;
            if ($r->hasFile('image')) {
                $image = $r->file('image');
                $imageName = $kode_barang . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_image'), $imageName);
            }
            $barang = Barang::create([
                'kode' => $kode_barang,
                'nama_barang' => $r->nama_barang,
                'merek' => $r->merek,
                'image' => $imageName,
                'kategori_id' => $r->kategori_id,
                'serial_number' => $r->serial_number,
                'spesifikasi' => $r->spesifikasi,
                'tempat_barang' => $r->tempat_barang,
            ]);

            $data2 = [
                'barang_id' => $barang->id,
                'debit' => 0,
                'kredit' => 0,
                'ket' => 'Stok Awal',
                'cabang_id' => $r->cabang_id,
                'harga' => 0,
                'tanggal' => date('Y-m-d')
            ];
            Stok::create($data2);

            return redirect()->route('barang.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('barang.index')->with('error', 'Data Gagal Disimpan');
        }
    }

    public function delete($id)
    {
        $pembelian = PembelianBarang::where('barang_id', $id)->first();
        $peminjaman = PeminjamanAsset::where('barang_id', $id)->first();
        $perbaikan = PerbaikanAsset::where('barang_id', $id)->first();
        $permintaan = PermintaanBarang::where('barang_id', $id)->first();
        $disposal = Disposal::where('barang_id', $id)->first();
        if (empty($peminjaman) || empty($perbaikan) || empty($permintaan) || empty($disposal) || empty($pembelian)) {
            Barang::find($id)->delete();
            Stok::where('barang_id', $id)->where('ket', 'Stok Awal')->delete();
            return redirect()->route('barang.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('barang.index')->with('error', 'Data Gagal dihapus karena sudah ada data transaksinya');
        }
    }

    public function getEdit(Request $r)
    {
        $cabang_id = Auth::user()->cabang_id;
        $data = [
            'title' => 'Edit Suplier',
            'barang' => Barang::find($r->id),
            'kategori' => KategoriAsset::all(),
            'cabang_id' => $cabang_id
        ];
        return view('barang.edit', $data);
    }

    public function update(Request $r)
    {
        try {
            // Cari barang berdasarkan ID yang dikirim
            $barang = Barang::findOrFail($r->id);

            // Default pakai gambar lama
            $imageName = $barang->image;

            // Jika upload gambar baru
            if ($r->hasFile('image')) {
                $image = $r->file('image');

                // Hapus gambar lama jika ada
                if ($imageName && file_exists(public_path('product_image/' . $imageName))) {
                    unlink(public_path('product_image/' . $imageName));
                }

                // Nama gambar bisa pakai kode_barang atau ID, disesuaikan
                $imageName = $barang->kode . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('product_image'), $imageName);
            }

            // Update data barang
            $barang->update([
                'nama_barang' => $r->nama_barang,
                'merek' => $r->merek,
                'image' => $imageName,
                'kategori_id' => $r->kategori_id,
                'serial_number' => $r->serial_number,
                'spesifikasi' => $r->spesifikasi,
                'tempat_barang' => $r->tempat_barang,
            ]);

            return redirect()->route('barang.index')->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('barang.index')->with('error', 'Data Gagal Diupdate: ' . $th->getMessage());
        }
    }
}
