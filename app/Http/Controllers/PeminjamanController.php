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
use Illuminate\Support\Facades\Storage;
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

            // Buat invoice kode
            $invoice = PeminjamanAsset::latest('urutan')->first();
            $invoice = empty($invoice) ? 1001 : $invoice->urutan + 1001;
            $invoice_kode = 'KPA' . $invoice;

            // Simpan file upload jika ada
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $imageName = $invoice_kode . '.' . $image->getClientOriginalExtension(); // tambah ekstensi file
                $image->move(public_path('peminjaman_image'), $imageName);
            }

            // Simpan ke database
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



            // Kirim notifikasi ke manager
            $managers = User::where('role', 'manager')->get();
            foreach ($managers as $manager) {
                Notifikasi::create([
                    'judul' => 'Peminjaman ' . $invoice_kode,
                    'deskripsi' => 'Peminjaman asset baru',
                    'link' => 'peminjaman.index',
                    'user_id' => $manager->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-journal-bookmark',
                    'status' => 'berhasil'
                ]);
            }

            return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            // Debug jika gagal
            return redirect()->route('peminjaman.index')->with('error', 'Data Gagal Disimpan: ' . $th->getMessage());
        }
    }
    public function update(Request $request)
    {
        try {
            $imageName = null;

            // Buat invoice kode



            // Simpan file upload jika ada
            // if ($request->hasFile('file')) {
            //     $image = $request->file('file');
            //     $imageName = $invoice_kode . '.' . $image->getClientOriginalExtension(); // tambah ekstensi file
            //     $image->move(public_path('peminjaman_image'), $imageName);
            // }
            $peminjaman = PeminjamanAsset::findOrFail($request->id);
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($peminjaman->file && file_exists(public_path('peminjaman_image/' . $peminjaman->file))) {
                    unlink(public_path('peminjaman_image/' . $peminjaman->file));
                }

                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = $peminjaman->invoice .  '.' . $ext;
                $image->move(public_path('karyawan_image'), $imageName);
            } else {
                // Jika tidak ada gambar baru, tetap pakai yang lama
                $imageName = $peminjaman->file;
            }

            // Simpan ke database
            $data = [
                'karyawan_id' => $request->karyawan_id,
                'barang_id' => $request->barang_id,
                'invoice' => $peminjaman->invoice,
                'tgl_pinjam' => date('Y-m-d'),
                'qty' => $request->qty,
                'qty_disposal' => 0,
                'urutan' => $peminjaman->urutan,
                'ket' => $request->ket,
                'cabang_id' => Auth::user()->cabang_id,
                'status' => 'pending',
                'file' => $imageName
            ];
            PeminjamanAsset::where('id', $request->id)->update($data);



            // Kirim notifikasi ke manager
            $managers = User::where('role', 'manager')->get();
            Notifikasi::where('judul', 'Peminjaman' . $peminjaman->invoice)->delete();
            foreach ($managers as $manager) {

                Notifikasi::create([
                    'judul' => 'Peminjaman ' . $peminjaman->invoice,
                    'deskripsi' => 'Peminjaman asset baru',
                    'link' => 'peminjaman.index',
                    'user_id' => $manager->id,
                    'read' => 'unread',
                    'icon' => 'bi bi-journal-bookmark',
                    'status' => 'berhasil'
                ]);
            }

            return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            // Debug jika gagal
            return redirect()->route('peminjaman.index')->with('error', 'Data Gagal Disimpan: ' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $peminjaman = PeminjamanAsset::findOrFail($id); // cari dulu sebelum dihapus
        Notifikasi::where('judul', 'Peminjaman ' . $peminjaman->invoice)->delete();

        $peminjaman->delete(); // baru hapus
        return redirect()->route('peminjaman.index')->with('success', 'Data Berhasil Dihapus');
    }
    public function getQr(Request $r)
    {
        $data = [
            'title' => 'Detail Peminjaman',
            'id' => $r->id,
            'role' => Auth::user()->role,
            'peminjaman' => PeminjamanAsset::find($r->id),
        ];

        return view('peminjaman.getQr', $data);
    }
    public function printQr(Request $r)
    {
        $data = [
            'title' => 'Detail Peminjaman',
            'id' => $r->id,
            'role' => Auth::user()->role,
            'peminjaman' => PeminjamanAsset::find($r->id),
        ];

        return view('peminjaman.getQr2', $data);
    }


    public function detail_peminjaman(Request $r)
    {
        $data = [
            'title' => 'Detail Peminjaman',
            'peminjaman' => PeminjamanAsset::find($r->id),
            'role' => Auth::user()->role,
        ];

        return view('peminjaman.detail', $data);
    }
    public function getDataPeminjaman(Request $r)
    {
        $data = [
            'peminjaman' => PeminjamanAsset::find($r->id),
            'role' => Auth::user()->role,
        ];

        return view('peminjaman.getData', $data);
    }
    public function getDataPeminjaman2(Request $r)
    {
        $data = [
            'peminjaman' => PeminjamanAsset::find($r->id),

        ];

        return view('peminjaman.getData2', $data);
    }
    public function getDataEditPeminjaman(Request $r)
    {
        $data = [
            'peminjaman' => PeminjamanAsset::find($r->id),
            'role' => Auth::user()->role,
            'barang' => Barang::getBarangPilih(Auth::user()->cabang_id),
            'karyawan' => Karyawan::where('cabang_id', Auth::user()->cabang_id)->get()
        ];

        return view('peminjaman.getEdit', $data);
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
