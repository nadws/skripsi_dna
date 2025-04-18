<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{

    protected $fillable = [
        'cabang_id',
        'departemen_id',
        'nama',
        'tgl_lahir',
        'tempat_lahir',
        'tgl_gabung',
        'alamat',
        'jenis_kelamin',
        'foto'
    ];
    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }

    public function Departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }
}
