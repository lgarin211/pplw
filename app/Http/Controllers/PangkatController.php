<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    //
    public function index()
    {
        $pangkat = Pangkat::all();
        return view('admin.pangkat',compact('pangkat'));
    }
    public function create()
    {
        return view('admin.pangkat_create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $pangkat = new Pangkat();
        $pangkat->nama = $request->input('nama');
        $pangkat->save();

        return redirect('pangkat')->with('success','Data berhasil di simpan');

    }
    public function edit($id)
    {
        $pangkat = Pangkat::where('id',$id)->first();
        return view('admin.pangkat_edit',compact('pangkat'));
    }
    public function update(Request $request, $id)
    {
        $obrik = Pangkat::find($id);
        $obrik->nama = $request->input('nama');
        $obrik->save();

        return redirect('pangkat')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $obrik = Pangkat::where('id',$id)->first();
        $obrik->delete();

        return redirect('pangkat')->with('warning','Data berhasil di Hapus');
    }
}
