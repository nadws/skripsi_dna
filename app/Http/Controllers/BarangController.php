<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use App\Models\Stok;
use App\Models\KategoriAsset;
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
            'kategori' => KategoriAsset::all()

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
                'kategori_id' => $r->kategori_id
            ]);

            $data2 = [
                'barang_id' => $barang->id,
                'debit' => $r->stok_awal,
                'kredit' => 0,
                'ket' => 'Stok Awal',
                'cabang_id' => $r->cabang_id,
                'harga' => $r->harga,
                'tanggal' => date('Y-m-d')
            ];
            Stok::create($data2);

            return redirect()->route('barang.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('barang.index')->with('error', 'Data Gagal Disimpan');
        }
    }
}
