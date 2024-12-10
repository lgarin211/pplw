<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    //
     public function index(Request $request)
    {
        $kegiatan = '';
         if ($request->has('search')) {
            $data = Kegiatan::where('kegiatan','like','%'.$request->search.'%')->paginate(10);
        }else {
            # code...
            $data = Kegiatan::paginate(10);
        }
        $kegiatan = $request->search;
        return view('admin.kegiatan',compact('data','kegiatan'));
    }
    public function create()
    {
        $p = Pegawai::all();
        return view('admin.kegiatan_create',compact('p'));
    }
    public function store(Request $request)
    {

         $p = Kegiatan::where('nomor', $request->input('nomor'))->where('kegiatan', $request->input('kegiatan'))->where('id_pptk', $request->input('id_pptk'))->count();

          if ($p>0) {
            $k = Kegiatan::where('nomor', $request->input('nomor'))->where('kegiatan', $request->input('kegiatan'))->where('id_pptk', $request->input('id_pptk'))->first();
           return redirect('kegiatan_baru')->with('warning','sudah ada Kegiatan dengan nomor kegiatan '.$k->nomor.' dengan nama kegiatan '.$k->kegiatan.' dengan PPTK '.$k->pptk->nama_karyawan.'  ');
        }

        // dd($request->all());
        $reg = new Kegiatan();
        $reg->nomor = $request->input('nomor');
        $reg->kegiatan = $request->input('kegiatan');
        $reg->id_pptk = $request->input('id_pptk');
        $reg->save();

        return redirect('kegiatan')->with('success','Data berhasil di simpan');

    }
    public function edit($id)
    {
        $kegiatan = Kegiatan::where('id',$id)->first();
        $p = Pegawai::all();
        return view('admin.kegiatan_edit',compact('kegiatan','p'));
    }
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::find($id);
        $kegiatan->nomor = $request->input('nomor');
        $kegiatan->kegiatan = $request->input('kegiatan');
        $kegiatan->id_pptk = $request->input('id_pptk');
        $kegiatan->save();

        return redirect('kegiatan')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $kegiatan = Kegiatan::where('id',$id)->first();
        $kegiatan->delete();

        return redirect('kegiatan')->with('warning','Data berhasil di Hapus');
    }
}
