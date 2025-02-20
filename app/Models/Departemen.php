<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{

    protected $fillable = [
        'nama',
        'cabang_id'
    ];
    public function cabang() {
        return $this->belongsTo(Cabang::class, 'cabang_id');
    }
}
