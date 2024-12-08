<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    //
      public function index()
    {
        $jabatan = Jabatan::all();
        return view('admin.jabatan',compact('jabatan'));
    }
    public function create()
    {
        return view('admin.jabatan_create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,[
        'nama' => 'required|min:10|max:100'
        ]);
        $jabatan = new Jabatan();
        $jabatan->nama = $request->input('nama');
        $jabatan->save();

        return redirect('jabatan')->with('success','Data berhasil di simpan');
  
    }
    public function edit($id)
    {
        $jabatan = Jabatan::where('id',$id)->first();
        return view('admin.jabatan_edit',compact('jabatan'));
    }
    public function update(Request $request, $id)
    {        
        $obrik = Jabatan::find($id);
        $obrik->nama = $request->input('nama');
        $obrik->save();

        return redirect('jabatan')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $obrik = Jabatan::where('id',$id)->first();
        $obrik->delete();

        return redirect('jabatan')->with('warning','Data berhasil di Hapus');
    }
}
