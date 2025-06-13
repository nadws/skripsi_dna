<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use App\Models\Karyawan;
use App\Models\PeminjamanAsset;
use App\Models\Stok;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $peminjaman = PeminjamanAsset::where('cabang_id', Auth::user()->cabang_id)->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->role == 'manager') {
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

    public function formulir()
    {
        $data = [
            'title' => 'Formulir Peminjaman',
            'cabang' => Cabang::where('id', Auth::user()->cabang_id)->first(),
        ];
        return view('peminjaman.formulir', $data);
    }
    public function store(Request $request)
    {
        try {
            $imageName = null;

            $invoice = PeminjamanAsset::latest('urutan')->first();
            $invoice = empty($invoice) ? 1001 : $invoice->urutan + 1001;
            $invoice_kode = 'KPA' . $invoice;

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = $invoice_kode;
                $image->move(public_path('peminjaman_image'), $imageName);
            }

            $data = [
                'karyawan_id' => $request->karyawan_id,
                'barang_id' => $request->barang_id,
                'invoice' => $invoice_kode,
                'tgl_pinjam' => date('Y-m-d'),
                'qty' => $request->qty,
                'qty_disposal' => 0,
                'urutan' => $invoice,
                'ket' => $request->ket,
                'cabang_id' => Auth::user()->cabang_id,
                'status' => 'pending',
                'file' => $imageName
            ];
            $peminjaman = PeminjamanAsset::create($data);

            // Generate QR Code
            $url = url('peminjaman/detail/' . $invoice_kode);
            $qrCodePath = public_path('qrcodes/' . $invoice_kode . '.png');
            QrCode::format('png')->size(300)->generate($url, $qrCodePath);

            // Optional: simpan path QR di database kalau mau
            $peminjaman->update(['qr_code' => $invoice_kode . '.png']);

            $user = User::where('role', 'manager')->get();
            foreach ($user as $u) {
                $data3 = [
                    'judul' => 'Peminjaman ' . $invoice_kode,
                    'deskripsi' => 'Peminjaman asset baru',
                    'link' => 'peminjaman.index',
                    'user_id' => $u->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-journal-bookmark',
                    'status' => 'berhasil'
                ];
                Notifikasi::create($data3);
            }

            return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('peminjaman.index')->with('error', 'Data Gagal Disimpan');
        }
    }


    public function getDataPeminjaman(Request $r)
    {
        $data = [
            'peminjaman' => PeminjamanAsset::find($r->id),
            'role' => Auth::user()->role,
        ];

        return view('peminjaman.getData', $data);
    }

    public function accepted(Request $r)
    {

        $peminjaman = PeminjamanAsset::find($r->id);
        if ($r->status == 'approved') {
            $data = [
                'status' => 'approved',
            ];
            PeminjamanAsset::where('id', $r->id)->update($data);

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

            $user = User::where('cabang_id', $peminjaman->cabang_id)->get();
            foreach ($user as $u) {
                $data3 = [
                    'judul' => 'Peminjaman ' . $peminjaman->invoice,
                    'deskripsi' => 'Peminjaman asset disetujui',
                    'link' => 'peminjaman.index',
                    'user_id' => $u->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-journal-bookmark',
                    'status' => 'berhasil'
                ];
                Notifikasi::create($data3);
            }
        } else {
            $data = [
                'status' => 'rejected',
                'ket_presiden' => $r->ket_presiden,
            ];
            PeminjamanAsset::where('id', $r->id)->update($data);
            $user = User::where('cabang_id', $peminjaman->cabang_id)->get();
            foreach ($user as $u) {
                $data3 = [
                    'judul' => 'Peminjaman ' . $peminjaman->invoice,
                    'deskripsi' => 'Peminjaman asset ditolak',
                    'link' => 'peminjaman.index',
                    'user_id' => $u->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-journal-bookmark',
                    'status' => 'berhasil'
                ];
                Notifikasi::create($data3);
            }
        }
        return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Disimpan');
    }
}
