<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Karyawan;
use App\Models\PeminjamanAsset;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $peminjaman = PeminjamanAsset::where('cabang_id', Auth::user()->cabang_id)->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->role == 'presiden') {
            $peminjaman = PeminjamanAsset::orderBy('id', 'desc')->get();
        }
        $data = [
            'title' => 'Peminjaman Assets',
            'peminjaman' => $peminjaman,
            'role' => Auth::user()->role,
            'cabang_id' => Auth::user()->cabang_id,
            'barang' => Barang::getBarangPilih(Auth::user()->cabang_id),
            'karyawan' => Karyawan::where('cabang_id', Auth::user()->cabang_id)->get()

        ];
        return view('peminjaman.index', $data);
    }
    public function store(Request $request)
    {
        try {
            $invoice = PeminjamanAsset::latest('urutan')->first();
            $invoice = empty($invoice) ? 1001 : $invoice->urutan + 1001;
            $invoice_kode = 'INV' . $invoice;



            $data = [
                'karyawan_id' => $request->karyawan_id,
                'barang_id' => $request->barang_id,
                'invoice' => $invoice_kode,
                'tgl_pinjam' => date('Y-m-d'),
                'qty' => $request->qty,
                'urutan' => $invoice,
                'ket' => $request->ket,
                'cabang_id' => Auth::user()->cabang_id,
                'status' => 'pengajuan',
            ];
            PeminjamanAsset::create($data);

            // $data2 = [
            //     'barang_id' => $request->barang_id,
            //     'debit' => 0,
            //     'kredit' => $request->qty,
            //     'ket' => 'Peminjaman ' . $invoice_kode,
            //     'cabang_id' => Auth::user()->cabang_id,
            //     'harga' => 0,
            //     'tanggal' => date('Y-m-d')
            // ];
            // Stok::create($data2);


            return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('peminjaman.index')->with('error', 'Data Gagal Disimpan');
        }
    }

    public function accepted($id)
    {
        try {
            $peminjaman = PeminjamanAsset::find($id);
            $data = [
                'status' => 'disetujui',
            ];
            PeminjamanAsset::where('id', $id)->update($data);

            $data2 = [
                'barang_id' => $peminjaman->barang_id,
                'debit' => 0,
                'kredit' => $peminjaman->qty,
                'ket' => 'Peminjaman ' . $peminjaman->invoice,
                'cabang_id' => $peminjaman->cabang_id,
                'harga' => 0,
                'tanggal' => date('Y-m-d')
            ];
            Stok::create($data2);
            return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('peminjaman.index')->with('error', 'Data Gagal Disimpan');
        }
    }
}
