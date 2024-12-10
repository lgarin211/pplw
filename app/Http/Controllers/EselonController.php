<?php

namespace App\Http\Controllers;

use App\Models\Eselon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class EselonController extends Controller
{
    //
     public function index()
    {
        $eselon = Eselon::all();
        return view('admin.eselon',compact('eselon'));
    }
    public function create()
    {
        return view('admin.eselon_create');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $pangkat = new Eselon();
        $pangkat->nama = $request->input('nama');
        $pangkat->save();

        return redirect('eselon')->with('success','Data berhasil di simpan');
  
    }
    public function edit($id)
    {
        $eselon = Eselon::where('id',$id)->first();
        return view('admin.eselon_edit',compact('eselon'));
    }
    public function update(Request $request, $id)
    {        
        $obrik = Eselon::find($id);
        $obrik->nama = $request->input('nama');
        $obrik->save();

        return redirect('eselon')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $obrik = Eselon::where('id',$id)->first();
        $obrik->delete();

        return redirect('eselon')->with('warning','Data berhasil di Hapus');
    }
}
