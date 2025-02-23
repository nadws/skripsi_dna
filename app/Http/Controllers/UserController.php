<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data User',
            'user' => User::all(),
            'cabang' => Cabang::all()
        ];
        return view('superadmin.user.index', $data);
    }

    public function store(Request $r)
    {
        $data = [
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt($r->password),
            'role' => $r->role,
            'cabang_id' => $r->cabang_id
        ];
        User::create($data);
        return redirect()->route('user.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function getEdit(Request $r)
    {
        $data = [
            'title' => 'Edit User',
            'user' => User::find($r->id),
            'cabang' => Cabang::all()
        ];
        return view('superadmin.user.edit', $data);
    }

    public function update(Request $r)
    {
        $data = [
            'name' => $r->name,
            'email' => $r->email,
            'role' => $r->role,
            'cabang_id' => $r->cabang_id
        ];
        if ($r->password != null) {
            $data['password'] = bcrypt($r->password);
        }
        User::where('id', $r->id)->update($data);
        return redirect()->route('user.index')->with('success', 'Data Berhasil Diubah');
    }
}
