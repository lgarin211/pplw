<?php

namespace App\Http\Controllers;

use App\Models\Peran;
use Illuminate\Http\Request;

class PeranController extends Controller
{
    //
    public function index()
    {
        $peran = Peran::paginate(5);
        return view('admin.peran',compact('peran'));
    }
    public function create()
    {
        $peran = Peran::select("sort_order")->orderBy("sort_order",'desc')->first();
        $sortOrder = $peran->sort_order >= 0 ? $peran->sort_order + 1 : 0;
        return view('admin.peran_create',compact('sortOrder'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

          $p = Peran::where('nama', $request->input('nama'))->where('tarif',$request->input('tarif'))->count();

          if ($p>0) {
            $k = Peran::where('nama', $request->input('nama'))->where('tarif',$request->input('tarif'))->first();
           return redirect('Peran_baru')->with('warning','sudah ada Peran '.$k->nama.' dengan tarif '.$k->tarif.' ');
        }

        $reg = new Peran();
        $reg->nama = $request->input('nama');
        $reg->tarif = $request->input('tarif');
        $reg->sort_order = $request->input('sort_order');
        $reg->save();

        return redirect('Peran')->with('success','Data berhasil di simpan');

    }
    public function edit($id)
    {
        $peran = Peran::where('id',$id)->first();

        $current_sort_order = Peran::select('sort_order')->orderBy('sort_order', 'desc')->first();
        $sort_order = $peran->sort_order  != null ? $peran->sort_order : ($current_sort_order->sort_order >= 0 ? $current_sort_order->sort_order + 1 : 0);
        return view('admin.peran_edit',compact('peran','sort_order'));
    }
    public function update(Request $request, $id)
    {
        $peran = peran::find($id);
        $peran->nama = $request->input('nama');
        $peran->tarif = $request->input('tarif');
        $peran->sort_order = $request->input('sort_order');
        $peran->save();

        return redirect('Peran')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $peran = Peran::where('id',$id)->first();
        $peran->delete();

        return redirect('Peran')->with('warning','Data berhasil di Hapus');
    }
}
