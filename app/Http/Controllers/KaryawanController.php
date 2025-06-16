<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Departemen;
use App\Models\PeminjamanAsset;
use App\Models\PerbaikanAsset;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Karyawan',
            'karyawan' => Karyawan::where('cabang_id', Auth::user()->cabang_id)->orderBy('id', 'desc')->get(),
            'cabang' => Cabang::all(),
            'departemen' => Departemen::where('cabang_id', Auth::user()->cabang_id)->get(),
            'cabang_id' => Auth::user()->cabang_id,
        ];
        return view('karyawan.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $request->nama . '.' . $request->tgl_lahir;
                $image->move(public_path('karyawan_image'), $imageName);
            }
            $data = [
                'nama' => $request->nama,
                'cabang_id' => $request->cabang_id,
                'departemen_id' => $request->departemen_id,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_gabung' => $request->tgl_gabung,
                'alamat' => $request->alamat,
                'foto' => $imageName
            ];
            Karyawan::create($data);
            return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            return redirect()->route('karyawan.index')->with('error', 'Data Gagal Disimpan');
        }
    }

    public function delete($id)
    {
        $peminjaman = PeminjamanAsset::where('karyawan_id', $id)->first();
        $perbaikan = PerbaikanAsset::where('karyawan_id', $id)->first();
        if (empty($peminjaman) || empty($perbaikan)) {
            Karyawan::find($id)->delete();
            return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('karyawan.index')->with('error', 'Data Gagal dihapus karena sudah ada data transaksinya');
        }
    }

    public function getEdit(Request $r)
    {
        $data = [
            'title' => 'Edit Suplier',
            'karyawan' => Karyawan::find($r->id),
            'departemen' => Departemen::where('cabang_id', Auth::user()->cabang_id)->get(),

        ];
        return view('karyawan.edit', $data);
    }

    public function update(Request $request)
    {
        try {
            $karyawan = Karyawan::findOrFail($request->id);

            // Jika ada file gambar baru
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($karyawan->foto && file_exists(public_path('karyawan_image/' . $karyawan->foto))) {
                    unlink(public_path('karyawan_image/' . $karyawan->foto));
                }

                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $imageName = $request->nama . '.' . $request->tgl_lahir . '.' . $ext;
                $image->move(public_path('karyawan_image'), $imageName);
            } else {
                // Jika tidak ada gambar baru, tetap pakai yang lama
                $imageName = $karyawan->foto;
            }

            $data = [
                'nama' => $request->nama,
                'cabang_id' => $request->cabang_id,
                'departemen_id' => $request->departemen_id,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tgl_gabung' => $request->tgl_gabung,
                'alamat' => $request->alamat,
                'foto' => $imageName
            ];

            $karyawan->update($data);

            return redirect()->route('karyawan.index')->with('success', 'Data Berhasil Diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('karyawan.index')->with('error', 'Data Gagal Diperbarui');
        }
    }
}
