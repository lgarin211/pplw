<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    //
     public function index()
    {
        $t = Tahun::all();
        return view('admin.tahun',compact('t'));
    }
    public function create()
    {
        return view('admin.tahun_create');
    }
    public function store(Request $request)
    {
        $t = new Tahun();
        $t->tahun = $request->input('tahun');
        $t->save();
        return redirect('tahun');
    }
    public function hapus($id)
    {
        $t = Tahun::find($id)->delete();
        return redirect('tahun');
    }

    public function checkTahun()
    {
        $th = Tahun::all();
        return view('admin.template');
    }
}
