<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Disposal;
use App\Models\Karyawan;
use App\Models\PeminjamanAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposalController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Disposal Asset',
            'disposal' => Disposal::where('cabang_id', Auth::user()->cabang_id)->orderBy('id', 'desc')->get(),
            'karyawan' => Karyawan::where('cabang_id', Auth::user()->cabang_id)->get(),

            'barang' => Barang::getBarang(Auth::user()->cabang_id)

        ];
        return view('disposal.index', $data);
    }

    public function store(Request $r)
    {
        if ($r->from == 'user') {
            $barang =  PeminjamanAsset::where('invoice', $r->barang_id)->first();
            $data = [
                'barang_id' => $barang->barang_id,
                'cabang_id' => Auth::user()->cabang_id,
                'karyawan_id' => $r->karyawan_id,
                'invoice_peminjaman' => $r->barang_id,
                'jumlah' => $r->jumlah,
                'keterangan' => $r->keterangan,
                'from' => $r->from,
                'status' => 'pending',
                'tgl_disposal' => date('Y-m-d'),
            ];
            Disposal::create($data);
        } else {
            $data = [
                'barang_id' => $r->barang_id,
                'cabang_id' => Auth::user()->cabang_id,
                'karyawan_id' => 0,
                'invoice_peminjaman' => 0,
                'jumlah' => $r->jumlah,
                'keterangan' => $r->keterangan,
                'from' => $r->from,
                'status' => 'pending',
                'tgl_disposal' => date('Y-m-d'),
            ];
            Disposal::create($data);
        }

        return redirect()->route('disposal.index')->with('success', 'Data Berhasil Disimpan');
    }
}
