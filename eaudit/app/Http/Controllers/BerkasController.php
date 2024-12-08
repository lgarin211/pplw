<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Pegawai;
use App\Models\Penugasan;
use App\Models\Skpd;
use App\Models\suratTugas;
use App\Models\JadwalLain;
use App\Models\JadwalLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerkasController extends Controller
{
    //
      public function index(Request $request)
    {

        // echo round($datediff / (60 * 60 * 24));
        if ($request->has('search')) {
            $surat = suratTugas::all();
            $penugasan = Penugasan::where('created_at','like','%'.session('tahun').'%')->where('noSurat	','like','%'.$request->search.'%')->orderBy('id','DESC')->paginate(5);
        }else {
            # code...
            $surat = suratTugas::all();
            $penugasan = Penugasan::where('created_at','like','%'.session('tahun').'%')->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->paginate(5);
        }

        return view('admin.berkas',compact('surat','penugasan','surat'));
    }

    public function bukti($id)
    {
        $penugasan = Penugasan::find($id);
        $skpd = Skpd::first();
        $k = Kegiatan::first();
        $surat = suratTugas::where('id_penugasan',$id)->get();

        // $pengurangan=[];
        // foreach ($surat as $key => $s2) {
        //     # code...
        //     $sekarang = strtotime($s2->ta);
        //     $akhir = strtotime($s2->tp);
        //     $idsurat = $s2->id;
        //     $idpegawai = $s2->id_karyawan;
        //     $pengurangan[$idsurat] = 0;
        //         // Loop between timestamps, 24 hours at a time
        //         for ( $i = $sekarang; $i <= $akhir; $i = $i + 86400 ) {
        //           if (date("D",$i)=='Sat' OR date("D",$i) == "Sun" ) {
        //               $pengurangan[$idsurat] += 1;
        //           }
        //           //mengambil data jadwal lain
        //           $tanggali = date("Y-m-d",$i);
        //           $jadwal = Jadwallain::where('id_pegawai','=',$idpegawai)->where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
        //           if ($jadwal > 0 ) {
        //             # code...
        //             $pengurangan[$idsurat] += 1;
        //           }
        //           $jadwalLibur = JadwalLibur::where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
        //           if ($jadwalLibur > 0) {
        //             # code...
        //             $pengurangan[$idsurat] += 1;
        //           }
        //           //mengambil data jadwal libur
        //         }
        // }

        // $total = 0;
        // foreach ($surat as $key => $v) {
        //     $idsurat= $v->id;
        //         $sekarang = strtotime($v->ta);
        //         $akhir = strtotime($v->tp);

        //         if (isset($pengurangan[$idsurat])) {
        //             # code...
        //             $totalpengurangan = $pengurangan[$idsurat];
        //         } else {
        //             # code...
        //             $totalpengurangan = 0;
        //         }

        //         $sampai = $akhir; // or your date as well
        //         $dari = $sekarang;
        //         $datediff = $sampai - $dari;

        //         if (empty($sampai)) {
        //             $jumlahHari = 0;
        //         } else {
        //             $jumlahHari =  round($datediff / (60 * 60 * 24))+1 - $totalpengurangan;
        //         }

        //         $total += ($jumlahHari  *  $v->peran->tarif);
        //     }


        //     $terbilang =  ucwords($this->terbilang($total))." Rupiah";




        return view('admin.bukti',compact('penugasan','skpd','k','surat'));
    }

    public function A2($id)
    {
        $penugasan = Penugasan::find($id);
        $skpd = Skpd::first();
        $k = Kegiatan::first();
        $surat = suratTugas::where('id_penugasan',$id)->get();

        // $pengurangan=[];
        // foreach ($surat as $key => $s2) {
        //     # code...
        //     $sekarang = strtotime($s2->ta);
        //     $akhir = strtotime($s2->tp);
        //     $idsurat = $s2->id;
        //     $idpegawai = $s2->id_karyawan;
        //     $pengurangan[$idsurat] = 0;
        //         // Loop between timestamps, 24 hours at a time
        //         for ( $i = $sekarang; $i <= $akhir; $i = $i + 86400 ) {
        //           if (date("D",$i)=='Sat' OR date("D",$i) == "Sun" ) {
        //               $pengurangan[$idsurat] += 1;
        //           }
        //           //mengambil data jadwal lain
        //           $tanggali = date("Y-m-d",$i);
        //           $jadwal = Jadwallain::where('id_pegawai','=',$idpegawai)->where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
        //           if ($jadwal > 0 ) {
        //             # code...
        //             $pengurangan[$idsurat] += 1;
        //           }
        //           $jadwalLibur = JadwalLibur::where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
        //           if ($jadwalLibur > 0) {
        //             # code...
        //             $pengurangan[$idsurat] += 1;
        //           }
        //           //mengambil data jadwal libur
        //         }
        // }

        // $total = 0;
        // foreach ($surat as $key => $v) {
        //     $idsurat= $v->id;
        //         $sekarang = strtotime($v->ta);
        //         $akhir = strtotime($v->tp);

        //         if (isset($pengurangan[$idsurat])) {
        //             # code...
        //             $totalpengurangan = $pengurangan[$idsurat];
        //         } else {
        //             # code...
        //             $totalpengurangan = 0;
        //         }

        //         $sampai = $akhir; // or your date as well
        //         $dari = $sekarang;
        //         $datediff = $sampai - $dari;

        //         if (empty($sampai)) {
        //             $jumlahHari = 0;
        //         } else {
        //             $jumlahHari =  round($datediff / (60 * 60 * 24))+1 - $totalpengurangan;
        //         }

        //         $total += ($jumlahHari  *  $v->peran->tarif);
        //     }
        //     $terbilang =  ucwords($this->terbilang($total))." Rupiah";

        return view('admin.a2',compact('penugasan','skpd','k','surat'));
    }
    public function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }

    public function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }



}
?>
