<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanAsset extends Model
{

    protected $fillable = [
        'karyawan_id',
        'barang_id',
        'invoice',
        'tgl_pinjam',
        'qty',
        'qty_disposal',
        'qty_pengembalian',
        'urutan',
        'ket',
        'cabang_id',
        'status',
        'ket_presiden',
        'file'
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
}
