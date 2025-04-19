<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function edit(Request $r)
    {
        Notifikasi::where('id', $r->id)->update(['read' => 'read']);

        $notifikasi = Notifikasi::where('id', $r->id)->first();
        return redirect()->route($notifikasi->link);
    }
}
