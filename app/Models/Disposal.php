<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposal extends Model
{
    protected  $fillable  = [
        'barang_id',
        'cabang_id',
        'karyawan_id',
        'jumlah',
        'keterangan',
        'from',
        'status',
        'tgl_disposal',
        'ket_presiden',
        'invoice_peminjaman'

    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
