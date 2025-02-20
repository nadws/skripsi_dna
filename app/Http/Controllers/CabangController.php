<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cabang;

class CabangController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Data Cabang',
            'cabang' => Cabang::all()
        ];

        return view('cabang.index',$data);
    }


}
