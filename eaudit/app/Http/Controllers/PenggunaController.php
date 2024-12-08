<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    //
     public function index()
    {
        $pengguna = User::paginate(5);
        return view('admin.pengguna',compact('pengguna'));
    }
    public function create()
    {
        return view('admin.pengguna_create');
    }
    public function register(Request $request)
    {
        // dd($request->all());
        $reg = new User();
        $reg->name = $request->input('name');
        $reg->username = $request->input('username');
        $reg->email = $request->input('email');
        $reg->password =bcrypt($request->password);
        $reg->level ="admin";
        $reg->save();

        return redirect('pengguna')->with('success','Data berhasil di simpan');
  
    }
    public function edit($id)
    {
        $pengguna = User::where('id',$id)->first();
        return view('admin.pengguna_edit',compact('pengguna'));
    }
    public function update(Request $request, $id)
    {        
        $pengguna = User::find($id);
        $pengguna->username = $request->input('username');
        $pengguna->email = $request->input('email');
        $pengguna->save();

        return redirect('pengguna')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $pengguna = User::where('id',$id)->first();
        $pengguna->delete();

        return redirect('pengguna')->with('warning','Data berhasil di Hapus');
    }
    public function show($id)
    {
        $pengguna = User::where('id',$id)->first();
        return view("admin.pengguna_detail", compact('pengguna'));
    }
}
