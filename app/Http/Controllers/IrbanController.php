<?php

namespace App\Http\Controllers;

use App\Models\Irban;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class IrbanController extends Controller
{
    //
    public function index()
    {
        $irban = Irban::all();
        return view('admin.irban',compact('irban'));
    }

    public function create()
    {
        $p = Pegawai::all();
        return view('admin.irban_create',compact('p'));
    }

    public function store(Request $request)
    {
        $irban = new Irban();
        $irban->nama = $request->input('nama');
        $irban->id_pegawai = $request->input('id_pegawai');
        $irban->save();

        return redirect('irban');
    }

    public function edit()
    {
        return view('admin.irban_edit');
    }

    public function update(Request $request, $id)
    {

    }

    public function hapus($id)
    {
        $irban = Irban::find($id);
        $irban->delete();
    }
}
