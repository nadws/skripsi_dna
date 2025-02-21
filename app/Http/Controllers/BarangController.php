<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'presiden') {
            $cabang_id = 0;
        } else {
            $cabang_id = Auth::user()->cabang_id;
        }
        $kode_barang = Barang::latest('kode')->first();
        $kode_barang = empty($kode_barang->kode) ? 'BRG0001' : substr($kode_barang->kode, 3) + 1;
        $data = [
            'title' => 'Daftar Barang',
            'barang' =>  Barang::getBarang($cabang_id),
            'role' => Auth::user()->role,
            'kode_barang' => $kode_barang,
            'cabang_id' => $cabang_id,
            'nama_cabang' => Cabang::find($cabang_id)->nama

        ];
        return view('barang.index', $data);
    }

    public function store(Request $r)
    {
        try {

            $kode_barang = Barang::latest('kode')->first();
            $kode_barang = empty($kode_barang->kode) ? 'BRG0001' : 'BRG' . str_pad(substr($kode_barang->kode, 3) + 1, 4, '0', STR_PAD_LEFT);

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
                'image' => $imageName
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
