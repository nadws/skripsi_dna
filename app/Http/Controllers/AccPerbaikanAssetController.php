<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Karyawan;
use App\Models\PeminjamanAsset;
use App\Models\PerbaikanAsset;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class AccPerbaikanAssetController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengajuan perbaikan',
            'perbaikan' => PerbaikanAsset::all(),
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
            'ket_presiden' => $r->ket_presiden
        ];
        PerbaikanAsset::where('id', $r->id)->update($data);
        return redirect()->route('accperbaikan.index')->with('success', 'Data Berhasil Disimpan');
    }
}
