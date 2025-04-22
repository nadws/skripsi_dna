<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerbaikanAsset extends Model
{
    protected $fillable = [
        'barang_id',
        'cabang_id',
        'vendor_id',
        'karyawan_id',
        'jumlah',
        'biaya',
        'keterangan',
        'from',
        'status',
        'tgl_perbaikan',
        'tgl_estimasi',
        'ket_presiden',
        'status_perbaikan',
        'keterangan_crash'
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
