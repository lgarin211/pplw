<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Penugasan;
use App\Models\Skpd;
use App\Models\suratTugas;
use App\Models\JadwalLain;
use App\Models\JadwalLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SkpdController extends Controller
{
    //
    public function index()
    {
        $c = Skpd::first();
        $p = Pegawai::all();
        return view('admin.skpd',compact('c','p'));
    }

     public function admin()
    {
       $p = Pegawai::where('created_at','like','%'.session('tahun').'%')->count();
       $n = Penugasan::where('created_at','like','%'.session('tahun').'%')->count();

       return view('admin.admin',compact('surat','penugasan','tot'));
    }


    public function tampil()
    {
        $t = Skpd::first();
        $pegawai = Pegawai::where('created_at','like','%'.session('tahun').'%')->count();
        $n = Penugasan::where('created_at','like','%'.session('tahun').'%')->count();
        // $surat = suratTugas::join('penugasans', 'surat_tugas.id_penugasan', '=', 'penugasans.id')->join('perans','surat_tugas.id_peran', '=', 'perans.id')->where('penugasans.created_at','like','%'.session('tahun').'%')->get();

        $total = 0;

        $penugasan = Penugasan::whereYear('TanggalSurat',session('tahun'))->get();

        foreach ($penugasan as $ps) {
            # code...
            $total += ($ps->hitung);
        }



       return view('admin.index',compact('n','t','pegawai','penugasan','total'));
    }
    public function update(Request $request)
    {
        $s = Skpd::first();
        $s->instansi = $request->input('instansi');
        $s->skpd = $request->input('skpd');
        $s->alamat = $request->input('alamat');
        $s->telp = $request->input('telp');
        $s->website = $request->input('website');
        $s->email = $request->input('email');
        $s->kodepos = $request->input('kodepos');
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename  = time().'.'.$extension;
            $file->move('logo',$filename);
            $s->logo = $filename;
            }
        $s->id_pegawai = $request->input('id_pegawai');
        $s->id_bendahara = $request->input('id_bendahara');
        $s->save();

        return redirect('skpd')->with('success','Data berhasil di Edit');
    }

    public function updatenomor(Request $request)
    {
        $s = Skpd::first();
        $s->nomordalam = $request->input('nomordalam');
        $s->save();

        return redirect('skpd')->with('info','Data berhasil di Edit');
    }
}
