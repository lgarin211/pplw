<?php

namespace App\Http\Controllers;

use App\Models\Obrik;
use Illuminate\Http\Request;

class ObrikController extends Controller
{
    //
      public function index(Request $request)
    {
        $obrik = '';
           if ($request->has('search')) {
            $data = Obrik::where('nama','like','%'.$request->search.'%')->paginate(10);
        }else {
            # code...
            $data = Obrik::paginate(10);
        }
        $obrik = $request->search;
        return view('admin.obrik',compact('data','obrik'));
    }
    public function create()
    {
        return view('admin.obrik_create');
    }
    public function store(Request $request)
    {
        // dd($request->all());

         $p = Obrik::where('nama', $request->input('nama'))->count();

          if ($p>0) {
            $k = Obrik::where('nama', $request->input('nama'))->first();
           return redirect('obrik_baru')->with('warning','sudah ada Obrik '.$k->nama.' ');
        }
        $reg = new Obrik();
        $reg->nama = $request->input('nama');
        $reg->save();

        return redirect('obrik')->with('success','Data berhasil di simpan');

    }
    public function edit($id)
    {
        $obrik = Obrik::where('id',$id)->first();
        return view('admin.obrik_edit',compact('obrik'));
    }
    public function update(Request $request, $id)
    {
        $obrik = Obrik::find($id);
        $obrik->nama = $request->input('nama');
        $obrik->save();

        return redirect('obrik')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $obrik = Obrik::where('id',$id)->first();
        $obrik->delete();

        return redirect('obrik')->with('warning','Data berhasil di Hapus');
    }
}
