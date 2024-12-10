<?php

namespace App\Http\Controllers;

use App\Models\JadwalLain;
use App\Models\JadwalLibur;
use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\suratTugas;
use App\Models\Tahun;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KendaliController extends Controller
{
    //
      public function index()
    {
        $month = '';
        $filterbulan = '';
           $filtertahun = '';
           $jadwalLibur = [];


          $th = Tahun::all();
          $surat = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();
          $tanggal=array();
          $month = date('m');
          $year = date('Y');

          for($d=1; $d<=31; $d++)
          {
              $time=mktime(12, 0, 0, $month, $d, $year);
              if (date('m', $time)==$month)
                  $tanggal[]=date('Y-m-d', $time);
                  $t = date('Y-m-d', $time);
                   $libur = JadwalLibur::whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();

                   if ($libur > 0) {
                    # code...
                    $jadwalLibur[$t] = '';
                   }

          }






          foreach ($surat as $key1 => $s) {
            # code...
            foreach ($tanggal as $key2 => $t) {
              # code...
              $suratTugas = suratTugas::where('id_karyawan','=',$s->id)->whereDate('ta','<=', $t)->whereDate('tp','>=', $t)->count();
              $jadwal      = JadwalLain::where('id_pegawai','=',$s->id)->whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->get();

              // print_r($suratTugas1);
              if ($suratTugas > 0) {
                # code...
                $keterangan[$s->id][$t] = 'ada';
              }elseif (count($jadwal) > 0) {
                # code...
                $keterangan[$s->id][$t] = '';
                foreach ($jadwal as $key => $value) {
                  # code...
                  $keterangan[$s->id][$t] .= $value->keterangan    ;
                  if ( $key < (count($jadwal)-1))   {
                  $keterangan[$s->id][$t] .= ', '    ;
                    # code...

                  }

                }
              }else {
                # code...
                $keterangan[$s->id][$t] = '';
              }
            }
          }

        //   echo "<pre>";
        //   print_r($jadwalLibur);
        //   echo "</pre>";
        //   exit();







            return view('admin.kendali',compact('th','month','surat','tanggal','keterangan','filterbulan','filtertahun','jadwalLibur'));

    }

     public function Cari(Request $request)
    {

        $jadwalLibur = [];
        $month = '';

          $th = Tahun::all();
          $surat = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();
          $tanggal=array();
          $month = $request->input('bulan');

          $year = session('tahun');

          for($d=1; $d<=31; $d++)
          {
            $time=mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time)==$month)
                $tanggal[]=date('Y-m-d', $time);
                $t = date('Y-m-d', $time);
                 $libur = JadwalLibur::whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();

                 if ($libur > 0) {
                  # code...
                  $jadwalLibur[$t] = '';
                 }
            }

            foreach ($surat as $key1 => $s) {
                # code...
                foreach ($tanggal as $key2 => $t) {
              # code...
              $suratTugas1 = suratTugas::where('id_karyawan','=',$s->id)->whereDate('ta','<=', $t)->whereDate('tp','>=', $t)->count();
              $jadwal      = JadwalLain::where('id_pegawai','=',$s->id)->whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();
              // print_r($suratTugas1);
              if ($suratTugas1 > 0) {
                # code...
                $keterangan[$s->id][$t] = 'ada';
              }elseif ($jadwal > 0) {
                # code...
                $keterangan[$s->id][$t] = 'DL';
              }
              else {
                # code...
                $keterangan[$s->id][$t] = '';
              }
            }
          }

          $arrayBulan =  array(
            '01'  =>  'Januari',
            '02'  =>  'Februari',
            '03'  =>  'Maret',
            '04'  =>  'April',
            '05'  =>  'Mei',
            '06'  =>  'Juni',
            '07'  =>  'Juli',
            '08'  =>  'Agustus',
            '09'  =>  'September',
            '10' =>   'Oktober',
            '11' =>   'November',
            '12' =>   'Desember'
    );


    $filterbulan = $arrayBulan[$request->input('bulan')];

    $filtertahun = $request->input('tahun');


      return view('admin.kendali',compact('th','month','surat','tanggal','keterangan','filterbulan','filtertahun','jadwalLibur'));

    }

    public function jadwalLain()
    {
        $jd = JadwalLain::all();
        $pegawai = Pegawai::all();
        return view('admin.jadwalLain',compact('jd','pegawai'));
    }

    public function jadwalLaincreate()
    {
       $pegawai = Pegawai::all();
       return view('admin.jadwalLain_create',compact('pegawai'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $reg = new JadwalLain();
        $reg->id_pegawai	 = $request->input('id_pegawai');
        $reg->tanggalawal    = $request->input('tanggalawal');
        $reg->tanggalakhir   = $request->input('tanggalakhir');
        $reg->keterangan     = 'DL';
        $reg->save();





        return redirect('jadwal_lain')->with('success','Data berhasil di simpan');

    }
    public function hapus($id)
    {
        $kegiatan = JadwalLain::where('id',$id)->first();
        $kegiatan->delete();

        return redirect('jadwal_lain')->with('danger','Data berhasil di Hapus');

    }

    public function jadwalLibur()
    {
      $jl = JadwalLibur::paginate(5);
      return view('admin.jadwalLibur',compact('jl'));
    }

    public function jadwalLiburcreate()
    {
       $pegawai = Pegawai::all();
       return view('admin.jadwalLibur_create',compact('pegawai'));
    }
     public function storeLibur(Request $request)
    {
        // dd($request->all());
        $reg = new JadwalLibur();
        $reg->tanggalawal  = $request->input('tanggalawal');
        $reg->tanggalakhir = $request->input('tanggalakhir');
        $reg->keterangan = $request->input('keterangan');
        $reg->save();



        return redirect('jadwal_libur')->with('success','Data berhasil di simpan');

    }

    public function hapusLibur($id)
    {
        $Libur = JadwalLibur::where('id',$id)->first();
        $Libur->delete();

        return redirect('jadwal_libur')->with('warning','Data berhasil di Hapus');
    }

    public function cetakKendali(Request $request)
    {
        $month = '';
        $filterbulan = '';
           $filtertahun = '';
           $jadwalLibur = [];


          $th = Tahun::all();
          $surat = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();
          $tanggal=array();
          $month = date('m','08');
          $year = date('Y');

          for($d=1; $d<=31; $d++)
          {
              $time=mktime(12, 0, 0, $month, $d, $year);
              if (date('m', $time)==$month)
                  $tanggal[]=date('Y-m-d', $time);
                  $t = date('Y-m-d', $time);
                   $libur = JadwalLibur::whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();

                   if ($libur > 0) {
                    # code...
                    $jadwalLibur[$t] = '';
                   }

          }






          foreach ($surat as $key1 => $s) {
            # code...
            foreach ($tanggal as $key2 => $t) {
              # code...
              $suratTugas = suratTugas::where('id_karyawan','=',$s->id)->whereDate('ta','<=', $t)->whereDate('tp','>=', $t)->count();
              $jadwal      = JadwalLain::where('id_pegawai','=',$s->id)->whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->get();

              // print_r($suratTugas1);
              if ($suratTugas > 0) {
                # code...
                $keterangan[$s->id][$t] = 'ada';
              }elseif (count($jadwal) > 0) {
                # code...
                $keterangan[$s->id][$t] = '';
                foreach ($jadwal as $key => $value) {
                  # code...
                  $keterangan[$s->id][$t] .= $value->keterangan    ;
                  if ( $key < (count($jadwal)-1))   {
                  $keterangan[$s->id][$t] .= ', '    ;
                    # code...

                  }

                }
              }
            }
          }

        //   echo "<pre>";
        //   print_r($jadwalLibur);
        //   echo "</pre>";
        //   exit();







            return view('admin.cetakKendali',compact('th','month','surat','tanggal','keterangan','filterbulan','filtertahun','jadwalLibur'));

    }
}


