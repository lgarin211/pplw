<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPengawasan;

class JenisPengawasanController extends Controller
{
    //
     public function index(Request $request)
    {
        $jenisPengawasan = '';
        if ($request->has('search')) {
            $data = JenisPengawasan::where('nama','like','%'.$request->search.'%')->paginate(10);
        }else {
            # code...
            $data = JenisPengawasan::paginate(10);
        }
        $jenisPengawasan = $request->search;

        return view('admin.jenisPengawasan',compact('data','jenisPengawasan'));
    }
    public function create()
    {
        return view('admin.jenisPengawasan_create');
    }
    public function store(Request $request)
    {

         $p = JenisPengawasan::where('nama', $request->input('nama'))->count();

          if ($p>0) {
            $k = JenisPengawasan::where('nama', $request->input('nama'))->first();
           return redirect('jenisPengawasan_baru')->with('warning','sudah ada Jenis Kegiatan '.$k->nama.' ');
        }

        // dd($request->all());
        $jp = new JenisPengawasan();
        // $jp->kode = $request->input('kode');
        $jp->nama = $request->input('nama');
        $jp->save();

        return redirect('jenisPengawasan')->with('success','Data berhasil di simpan');

    }
    public function edit($id)
    {
        $jp = JenisPengawasan::where('id',$id)->first();
        return view('admin.jenisPengawasan_edit',compact('jp'));
    }
    public function update(Request $request, $id)
    {
        $jp = JenisPengawasan::find($id);
        // $jp->kode = $request->input('kode');
        $jp->nama = $request->input('nama');
        $jp->save();

        return redirect('jenisPengawasan')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $jp = JenisPengawasan::where('id',$id)->first();
        $jp->delete();

        return redirect('jenisPengawasan')->with('warning','Data berhasil di Hapus');
    }

    public function cari(Request $request){
          if (isset($_GET['search'])) {
            # code...
            echo "Hello";
        }else{
            echo "cek";
        }
    }
}
