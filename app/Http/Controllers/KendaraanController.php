<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Transportasi;

class KendaraanController extends Controller
{
    //
    public function index()
    {
        $transportasi = Transportasi::all();
        return view('admin.kendaraan',compact('transportasi'));
    }

    public function kendaraanCreate()
    {
        return view('admin.kendaraan_create');
    }

    public function storekendaraan(Request $request)
    {
        $t = new Transportasi();
        $t->kode = $request->input('kode');
        $t->save();

        return redirect('kendaraan')->with('success','Data berhasil di simpan');
    }

    public function edit($id)
    {
        $t = Transportasi::where('id',$id)->first();
        return view('admin.kendaraan_edit',compact('t'));
    }

    public function update(Request $request,$id)
    {
        $t = Transportasi::find($id);
        $t->kode = $request->input('kode');
        $t->save();

        return redirect('kendaraan')->with('info','Data berhasil di Edit');
    }

     public function hapus($id)
    {
        $t = Transportasi::find($id);
        $t->delete();

        return redirect('kendaraan')->with('warning','Data berhasil di Hapus');
    }
}
