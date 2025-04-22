<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cabang;
use App\Models\Notifikasi;
use App\Models\OverBarang;
use App\Models\PembelianBarang;
use App\Models\PermintaanBarang;
use App\Models\Suplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermintaanBarangController extends Controller
{
    public function index()
    {
        $invoice = PermintaanBarang::max('invoice');
        $invoice = empty($invoice) ? 1001 : $invoice + 1;
        $data = [
            'title' => 'Permintaan Barang',
            'permintaan' => PermintaanBarang::where('cabang_id', Auth::user()->cabang_id)->orderBy('id', 'desc')->get(),
            'barang' => Barang::all(),
            'invoice' => $invoice,
            'cabang' => Cabang::where('id', '!=', Auth::user()->cabang_id)->get(),
            'suplier' => Suplier::all(),
        ];
        return view('permintaanbarang.index', $data);
    }

    public function get_asset(Request $r)
    {
        $barang = Barang::getBarang($r->cabang_id);

        echo "<option value=''>Pilih Barang</option>";
        foreach ($barang as $b) {
            echo "<option value='$b->id'>$b->nama_barang ($b->merek)</option>";
        }
    }
    public function get_stock(Request $r)
    {
        $barang = Barang::getBarangOne($r->barang_id, $r->cabang_id);

        return response()->json([
            'stok' => $barang->stok,
            'harga' => $barang->harga_terbaru,
        ]);
    }

    public function store(Request $r)
    {
        try {
            DB::beginTransaction(); // Mulai transaksi

            $invoice = PermintaanBarang::max('invoice');
            $invoice = empty($invoice) ? 1001 : $invoice + 1;

            if ($r->katgeori == 'pembelian') {
                $data = [
                    'invoice' => $invoice,
                    'cabang_id' => Auth::user()->cabang_id,
                    'barang_id' => $r->barang_id_pembelian,
                    'jumlah' => $r->jumlah_pembelian,
                    'kategori' => $r->katgeori,
                    'keterangan' => $r->keterangan,
                ];
                PermintaanBarang::create($data);

                $data2 = [
                    'invoice' => $invoice,
                    'barang_id' => $r->barang_id_pembelian,
                    'cabang_id' => Auth::user()->cabang_id,
                    'suplier_id' => $r->suplier_id_pembelian,
                    'jumlah' => $r->jumlah_pembelian,
                    'harga_satuan' => $r->harga_satuan_pembelian
                ];
                PembelianBarang::create($data2);
                $user = User::where('role', 'manager')->get();
                foreach ($user as $u) {
                    $data3 = [
                        'judul' => 'Permintaan Asset ' . $invoice,
                        'deskripsi' => 'Permintaan asset',
                        'link' => 'accpermintaan.index',
                        'user_id' => $u->id,
                        'read' => 'unread',
                        'icon' => 'bi bi-grid-fill',
                        'status' => 'berhasil'
                    ];
                    Notifikasi::create($data3);
                }
            } else {
                $data = [
                    'invoice' => $invoice,
                    'cabang_id' => Auth::user()->cabang_id,
                    'barang_id' => $r->barang_id_overstock,
                    'jumlah' => $r->jumlah_overstock,
                    'kategori' => $r->katgeori,
                    'keterangan' => $r->keterangan,
                ];
                PermintaanBarang::create($data);

                $data2 = [
                    'invoice' => $invoice,
                    'barang_id' => $r->barang_id_overstock,
                    'ke_cabang_id' => Auth::user()->cabang_id,
                    'dari_cabang_id' => $r->cabang_id_overstock,
                    'jumlah' => $r->jumlah_overstock,
                    'harga_satuan' => $r->harga_satuan_overstock
                ];
                OverBarang::create($data2);
                $user = User::where('role', 'manager')->get();
                foreach ($user as $u) {
                    $data3 = [
                        'judul' => 'Permintaan Over Stock Asset ' . $invoice,
                        'deskripsi' => 'Permintaan over stock asset',
                        'link' => 'accpermintaan.index',
                        'user_id' => $u->id,
                        'read' => 'unread',
                        'icon' => 'bi bi-grid-fill',
                        'status' => 'berhasil'
                    ];
                    Notifikasi::create($data3);
                }
            }

            DB::commit(); // Simpan semua perubahan jika berhasil

            return redirect()->route('permintaan.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            DB::rollBack(); // Batalkan semua perubahan jika terjadi error
            return redirect()->route('permintaan.index')->with('error', 'Data Gagal Disimpan: ' . $th->getMessage());
        }
    }
}
