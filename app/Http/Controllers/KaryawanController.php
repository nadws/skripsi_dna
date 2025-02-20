<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Cabang;
use App\Models\Departemen;

class KaryawanController extends Controller
{
    public function index(){
        $data =[
            'title' => 'Data Karyawan',
            'karyawan' => Karyawan::orderBy('id','desc')->get(),
            'cabang' => Cabang::all(),
            'departemen' => Departemen::all()
        ];
        return view('karyawan.index',$data);
    }
}
