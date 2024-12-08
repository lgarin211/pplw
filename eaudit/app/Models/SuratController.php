<?php

namespace App\Http\Controllers;

use App\Models\Skpd;
use App\Models\Irban;
use App\Models\Obrik;
use App\Models\Peran;
use App\Models\Tahun;
use App\Models\Pegawai;
use App\Models\Kegiatan;
use App\Models\Penugasan;
use App\Models\JadwalLain;
use App\Models\suratTugas;
use App\Exports\ExportUser;
use App\Models\JadwalLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\JenisPengawasan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class SuratController extends Controller
{
    public function indexDalam(Request $request)
    {

            if ($request->has('search')) {
                $surat = suratTugas::all();
                $penugasan = Penugasan::where('tanggalterbitSurat','like','%'.session('tahun').'%')->where('noSurat	','like','%'.$request->search.'%')->orderBy('TanggalAkhir','DESC')->paginate(5);
            }else {
                # code...
                $surat = suratTugas::all();
                $penugasan = Penugasan::where('tanggalterbitSurat','like','%'.session('tahun').'%')->orderBy('Tanggalsurat','DESC')->orderBy('noSurat','DESC')->paginate(5);
            }

            // $surat = suratTugas::join('perans','perans.id','=','surat_tugas.id_peran')->join('penugasans','penugasans.id','=','surat_tugas.id_penugasan')->where('penugasans.created_at','like','%'.session('tahun').'%')->orderBy('penugasans.Tanggalsurat','DESC')->orderBy('perans.id','asc')->paginate(5);

            return view('admin.suratTugasdalam',compact('surat','penugasan'));
    }
    public function CreateperjalananDalam()
    {
        $obrik = Obrik::all();
        $jp    = JenisPengawasan::all();
        $pe    = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();
        $K     = Kegiatan::all();
        $peran = Peran::all();
        $th    = Tahun::all();
        return view('admin.suratTugasdalam_create',compact('obrik','jp','pe','K','peran','th'));
    }
    public function store(Request $request)
    {

        $inputan['noSurat'] = $request->input('noSurat');
        $inputan['id_jenis_pengawasan'] = $request->input('id_jenis_pengawasan');
        $inputan['id_obrik'] = $request->input('id_obrik');
        $inputan['Tanggalsurat'] = $request->input('Tanggalsurat');
        $inputan['id_anggaran'] = $request->input('id_anggaran');
        $inputan['tanggalterbitSurat'] = $request->input('tanggalterbitSurat');
        $inputan['TanggalAkhir'] = $request->input('TanggalAkhir');
        $inputan['tugas'] = $request->input('tugas');
        $inputan['anggota'] = $request->input('anggota');

        #jika ada tanggal yang bentrok maka tanggal sebelumnya diubah

         $request->session()->put('inputan', $inputan);

        $p = Penugasan::where('id_jenis_pengawasan', $request->input('id_jenis_pengawasan'))->where('id_obrik',$request->input('id_obrik'))->where('Tanggalsurat','like','%'.date('Y').'%')->count();

        if ($p>0) {
            $k = Penugasan::where('id_jenis_pengawasan', $request->input('id_jenis_pengawasan'))->where('id_obrik',$request->input('id_obrik'))->where('Tanggalsurat','like','%'.date('Y').'%')->first();
           return redirect('perjalananDalam_create')->with('warning','sudah ada penugasan '.$k->jenis->nama.' ke '.$k->obrik->nama.' pada '.$k->Tanggalsurat.' s/d '.$k->TanggalAkhir.' apakah kegiatan ini akan di laksanakan lebih dari satu kali?');
        }

        $dobeljob = 'Terdapat pegawai yang sudah mempunyai jadwal penugasan antara lain:';
        $jumlahdobeljob = 0;
        foreach ($request->input('tugas') as $id_peran => $value) {
            # code...
            $ta = $value['ta'];
            $tp = $value['tp'];
            $id_karyawan = $value['id_karyawan'];
            $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ((ta <= '$ta' AND tp >= '$ta')  OR (ta >= '$ta' AND ta <= '$tp')) AND id_karyawan = '$id_karyawan' " );
        if ($s[0]->total > 0) {
            $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE  ((ta <= '$ta' AND tp >= '$ta')  OR (ta >= '$ta' AND ta <= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                $jumlahdobeljob += 1;
                $dobeljob .= '<br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada tanggal '.$z[0]->data4.' s/d '.$z[0]->data5.'.';
            }

        }

        $dobeljob .= ' <br> Apakah Anda tetap ingin memproses penugasan?';
        $dobeljob2 = $dobeljob;
        $jumlahdobeljob2 = $jumlahdobeljob;

        foreach ($request->input('anggota') as $id_peran => $value ) {

            foreach ($value as $id_anggota => $data) {
                if (!empty($data['id_karyawan'])) {
                    $ta = $data['ta'];
                    $tp = $data['tp'];
                    $id_karyawan = $data['id_karyawan'];

                    $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND id_karyawan = '$id_karyawan' " );
                    if ($s[0]->total > 0) {
                        $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE  ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                            $jumlahdobeljob2 += 1;
                            $dobeljob2 .= '<br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada tanggal '.$z[0]->data4.' s/d '.$z[0]->data5.'.';
                        }
                }
            }
        }

        // $dobeljob .= ' <br> Apakah Anda tetap ingin memproses penugasan?';
        // $dobeljob2 = $dobeljob;
        // $jumlahdobeljob2 = $jumlahdobeljob;


        if ($jumlahdobeljob2 > 0) {
            # code...
            // dd($request->all());
            return redirect('perjalananDalam_create')->with('danger', $dobeljob2)->withInput();

        }

         $x = session('inputan');

        $p = new Penugasan();
        $p->noSurat = $x['noSurat'];
        $p->id_jenis_pengawasan = $x['id_jenis_pengawasan'];
        $p->id_obrik = $x['id_obrik'];
        $p->Tanggalsurat = $x['Tanggalsurat'];
        $p->id_anggaran = $x['id_anggaran'];
        $p->tanggalterbitSurat = $x['tanggalterbitSurat'];
        $p->TanggalAkhir = $x['TanggalAkhir'];
        $p->save();
        $id_penugasan = $p->id;

        foreach ($x['tugas'] as $id_peran => $value ) {
            if (!empty($value['id_karyawan'])) {
                $value['id_penugasan'] = $id_penugasan;
                $value['id_peran'] = $id_peran;
                $this->databaru($value);
        }
    }
        if ($x['anggota']) {
            # code...
            foreach ($x['anggota'] as $id_peran => $value ) {

                foreach ($value as $id_anggota => $data) {
                if (!empty($data['id_karyawan'])) {
                    $data['id_penugasan'] = $id_penugasan;
                    $data['id_peran'] = $id_peran;
                    $this->databaru($data);
                    }


                }

            }
        }


        return redirect('perjalananDalam')->with('success','Data berhasil di simpan');

    }

    public function suratTugas($id)
    {
        $skpd = Skpd::first();
        $st = Penugasan::find($id);
        $surat = suratTugas::join('perans','perans.id','=','surat_tugas.id_peran')->where('id_penugasan',$id)->orderBy('perans.id','asc')->get();
        return view('admin.template_surat',compact('st','skpd','surat'));
    }

    public function suratperintah($id)
    {
        $st = Penugasan::find($id);
        $skpd = skpd::first();
        $k = kegiatan::first();
        $surat = suratTugas::where('id_penugasan',$id)->get();

         foreach ($surat as $key => $p) {
            # code...

            $ta = $p->ta;
            $tp = $p->tp;
            $id_karyawan = $p->id_karyawan;
            $id = $p->id;
                $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta >= '$tp' AND ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND id_karyawan = '$id_karyawan' AND id > '$id' " );
         $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND id_karyawan = '$id_karyawan' AND id > '$id' " );
                if ($s[0]->total > 0) {
            $z = DB::select("SELECT ta, tp FROM  surat_tugas WHERE  ta >= '$tp' AND ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND id_karyawan = '$id_karyawan' AND id > '$id' " );
            //  $taAkhir[$id] = $ta;
            //  $tpAkhir[$id] = date('Y-m-d',strtotime($z[0]->ta.' -2 day'));

             $taAkhir[$id] = 1;
             $tpAkhir[$id] = 1;

            }

        elseif ($s2[0]->total > 0) {
            $z2 = DB::select("SELECT ta, tp FROM  surat_tugas WHERE  ta <= '$tp' AND ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND id_karyawan = '$id_karyawan' AND id > '$id' " );
            $taAkhir[$id] = $ta;
             $tpAkhir[$id] = date('Y-m-d',strtotime($z2[0]->ta.' -1 day'));

            }

            else {
                $taAkhir[$id] = $ta;
                $tpAkhir[$id] = $tp;
            }


            // jika surat tugas kedua di hapus maka data surat tugas pertama kembali seperti semula

            // jika data surat tugas di kembalikan ke awal maka akan di tambahkan .

            // form edit surat berkaitan TA dan TP  menyesuaikan dari berkas



        }



        $pengurangan=[];
        foreach ($surat as $key => $s2) {
            # code...
            $sekarang = strtotime($s2->ta);
            $akhir = strtotime($s2->tp);
            $idsurat = $s2->id;
            $idpegawai = $s2->id_karyawan;
            $pengurangan[$idsurat] = 0;
                // Loop between timestamps, 24 hours at a time
                for ( $i = $sekarang; $i <= $akhir; $i = $i + 86400 ) {
                  if (date("D",$i)=='Sat' OR date("D",$i) == "Sun" ) {
                      $pengurangan[$idsurat] += 1;
                  }
                  //mengambil data jadwal lain
                  $tanggali = date("Y-m-d",$i);
                  $jadwal = Jadwallain::where('id_pegawai','=',$idpegawai)->where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
                  if ($jadwal > 0 ) {
                    # code...
                    $pengurangan[$idsurat] += 1;
                  }
                  $jadwalLibur = JadwalLibur::where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
                  if ($jadwalLibur > 0) {
                    # code...
                    $pengurangan[$idsurat] += 1;
                  }
                  //mengambil data jadwal libur
                }
        }

        $total = 0;
        foreach ($surat as $key => $v) {
            $idsurat= $v->id;
                $sekarang = strtotime($v->ta);
                $akhir = strtotime($v->tp);

                if (isset($pengurangan[$idsurat])) {
                    # code...
                    $totalpengurangan = $pengurangan[$idsurat];
                } else {
                    # code...
                    $totalpengurangan = 0;
                }

                $sampai = $akhir; // or your date as well
                $dari = $sekarang;
                $datediff = $sampai - $dari;

                if (empty($sampai)) {
                    $jumlahHari = 0;
                } else {
                    $jumlahHari =  round($datediff / (60 * 60 * 24))+1 - $totalpengurangan;
                }

                $total += ($jumlahHari  *  $v->peran->tarif);
            }
        return view('admin.suratDinas',compact('st','skpd','k','surat','taAkhir','tpAkhir','pengurangan'));

    }

    public function sppd($id)
    {
        $skpd = skpd::first();
        $st = Penugasan::find($id);
        $surat = suratTugas::where('id_penugasan',$id)->get();
        return view('admin.sppd',compact('st','skpd','surat'));

    }

    public function edit($id)
    {
        $jp = jenisPengawasan::all();
        $peran = Peran::all();
        $obrik = Obrik::all();
        $ag = Kegiatan::all();
        $pe    = Pegawai::all();
        $penugasan = Penugasan::where('id',$id)->first();
        $surat = suratTugas::where('id_penugasan',$id)->get();
        foreach ($surat as $key => $value) {
            $suratTugas[$value->id_peran] = $value;
        }

        $surat2 = suratTugas::where('id_penugasan',$id)->where('id_peran','8')->get();
        foreach ($surat2 as $key => $value) {
            $suratAnggota[($key+1)] = $value;
        }
        // dd($suratAnggota);

        return view('admin.suratTugasdalam_edit',compact('penugasan','jp','obrik','ag','surat','peran','pe','suratTugas','suratAnggota'));
    }

    public function update(Request $request, $id)
    {
        $inputan['noSurat'] = $request->input('noSurat');
        $inputan['id_jenis_pengawasan'] = $request->input('id_jenis_pengawasan');
        $inputan['id_obrik'] = $request->input('id_obrik');
        $inputan['Tanggalsurat'] = $request->input('Tanggalsurat');
        $inputan['id_anggaran'] = $request->input('id_anggaran');
        $inputan['tanggalterbitSurat'] = $request->input('tanggalterbitSurat');
        $inputan['TanggalAkhir'] = $request->input('TanggalAkhir');
        $inputan['tugas'] = $request->input('tugas');
        $inputan['anggota'] = $request->input('anggota');
        $inputan['ubahtugas'] = $request->input('ubahtugas');
        $inputan['ubahanggota'] = $request->input('ubahanggota');

        $request->session()->put('inputan', $inputan);
        $p = Penugasan::find($id);
        $karyawanlama = $p->surat()->pluck('id_karyawan')->toArray();
        $p->noSurat = $request->input('noSurat');
        $p->id_jenis_pengawasan = $request->input('id_jenis_pengawasan');
        $p->id_obrik = $request->input('id_obrik');
        $p->Tanggalsurat = $request->input('Tanggalsurat');
        $p->id_anggaran = $request->input('id_anggaran');
        $p->tanggalterbitSurat = $request->input('tanggalterbitSurat');
        $p->TanggalAkhir = $request->input('TanggalAkhir');



        $id_penugasan = $p->id;

        $karyawanbaru = [];

        //yg errorr skrip mengganti item nama tim yang terdiri dari penanggung jawab, anggota, dll.
        $st = suratTugas::where('id_penugasan',$id)->get();

         $dobeljob = 'Terdapat pegawai yang sudah mempunyai jadwal penugasan antara lain:';
         $jumlahdobeljob = 0;
         $inputTugas = $request->input('tugas')??[];
         if ($inputTugas) {
            # code...
            foreach ($inputTugas as $id_peran => $value) {
                # code...
                $ta = $value['ta'];
                $tp = $value['tp'];
                $id_karyawan = $value['id_karyawan'];
                $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE   ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND id_karyawan = '$id_karyawan' " );
                $s1 = suratTugas::whereRaw("((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND id_karyawan = '$id_karyawan' ")->first();
                // dd($s,$s1);
                if ($s1) {
                    # code...
                    $jumlahdobeljob += 1;
                    $dobeljob .= '<br> - pegawai '.$s1->pegawai->nama_karyawan.' sudah di tugaskan '.$s1->surat->jenis->nama.' ke  '.$s1->surat->obrik->nama.' pada tanggal '.$s1->ta.' s/d '.$s1->tp.'.';
                }
                // if ($s[0]->total > 0) {
                //     $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE  ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                //     $jumlahdobeljob += 1;
                //     $dobeljob .= '<br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada tanggal '.$z[0]->data4.' s/d '.$z[0]->data5.'.';
                // }

            }
        }
        if ($request->input('ubahtugas')) {
            foreach ($request->input('ubahtugas') as $id_suratTugas => $value) {
                # code...
                $ta = $value['ta'];
                $tp = $value['tp'];
                $id_karyawan = $value['id_karyawan'];
                $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE   ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND id_karyawan = '$id_karyawan' AND id != '$id_suratTugas' " );
            if ($s[0]->total > 0) {
               $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE  ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan' AND surat_tugas.id != '$id_suratTugas'" );
                    $jumlahdobeljob += 1;
                    $dobeljob .= '<br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada tanggal '.$z[0]->data4.' s/d '.$z[0]->data5.'.';
                }
            }
         }


         $dobeljob .= ' <br> Apakah Anda tetap ingin memproses penugasan?';
         $dobeljob2 = $dobeljob;
         $jumlahdobeljob2 = $jumlahdobeljob;
         if ($request->input('anggota')) {
             if ($request->input('anggota')) {
                 # code...
                 foreach ($request->input('anggota') as $id_peran => $value ) {


                    foreach ($value as $id_anggota => $data) {
                        if (!empty($data['id_karyawan'])) {
                             $ta = $data['ta'];
                             $tp = $data['tp'];
                           $id_karyawan = $data['id_karyawan'];

                           $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND id_karyawan = '$id_karyawan' " );


                           if ($s[0]->total > 0) {
                              $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE  ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                              $jumlahdobeljob2 += 1;
                              $dobeljob2 .= '<br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada tanggal '.$z[0]->data4.' s/d '.$z[0]->data5.'.';
                               }
                            }
                   }

                }
            }
         }


         if ($request->input('ubahanggota')) {
            foreach ($request->input('ubahanggota') as $id_suratTugas => $value) {
                # code...
                if (!empty($value['id_karyawan'])) {
                   $ta = $value['ta'];
                   $tp = $value['tp'];
                   $id_karyawan = $value['id_karyawan'];
                   $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE   ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND id_karyawan = '$id_karyawan' AND id != '$id_suratTugas' " );
                   if ($s[0]->total > 0) {
                      $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE  ((ta <= '$ta' AND tp >= '$ta') OR (ta >= '$ta' AND ta <= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan' AND surat_tugas.id != '$id_suratTugas'" );
                           $jumlahdobeljob2 += 1;
                           $dobeljob2 .= '<br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada tanggal '.$z[0]->data4.' s/d '.$z[0]->data5.'.';
                       }

               }

            }
         }
        //  dd($jumlahdobeljob2);
         if ($jumlahdobeljob2 > 0) {
            # code...
            return redirect('perjalananDalam/'.$id.'/edit')->with('danger', $dobeljob2)->withInput();
        }

        $p->update();



        //  $dobeljob .= ' <br> Apakah Anda tetap ingin memproses penugasan?';
        //  $dobeljob2 = $dobeljob;
        //  $jumlahdobeljob2 = $jumlahdobeljob;


            $x = session('inputan');
            // dd('update',$x);

            if ($x['tugas']) {

                # code...
                foreach ($x['tugas'] as $id_peran => $value ) {

                    if (!empty($value['id_karyawan'])) {
                        array_push($karyawanbaru,$value['id_karyawan']);
                        $value['id_penugasan'] = $id_penugasan;
                        $value['id_peran'] = $id_peran;
                        $this->databaru($value);
                    }
                }

        foreach ($x['ubahtugas'] as $id_suratTugas => $value ) {

            if (!empty($value['id_karyawan'])) {
                array_push($karyawanbaru,$value['id_karyawan']);
                $value['id_penugasan'] = $id_penugasan;
                $value['id_peran'] = $id_peran;
                $this->databaru($value);
        }
    }         if ($x['anggota']) {
        # code...
        foreach ($x['anggota'] as $id_peran => $value ) {

            foreach ($value as $id_anggota => $data) {

                if (!empty($data['id_karyawan'])) {
                    array_push($karyawanbaru,$data['id_karyawan']);
                    $data['id_penugasan'] = $id_penugasan;
                    $data['id_peran'] = $id_peran;
                    $this->databaru($data);
                }
            }

            }

    }

            foreach ($x['ubahanggota'] as $id_suratTugas => $data) {

                if (!empty($data['id_karyawan'])) {
                    array_push($karyawanbaru,$data['id_karyawan']);
                    $data['id_penugasan'] = $id_penugasan;
                    $data['id_peran'] = $id_peran;
                    $this->databaru($data);
                }
            }

            $karyawanhapus = array_diff($karyawanlama,$karyawanbaru);
            suratTugas::where('id_penugasan',$id_penugasan)->whereIn('id_karyawan',$karyawanhapus)->delete();
            // dd($karyawanlama,$karyawanbaru,$karyawanhapus);





        // return redirect()->route('surat.edit')->with('info','Data berhasil di Edit');


        return redirect('perjalananDalam')->with('success','Data berhasil di simpan');
    }
    }
    public function hapus($id)
    {
        $obrik = Penugasan::where('id',$id)->delete();

        $obrik = suratTugas::where('id_penugasan',$id)->delete();

        return redirect('perjalananDalam')->with('warning','Data berhasil di Hapus');
    }

    public function indexBaru(Request $request)
    {
        // return view('admin.arsip',compact('obrik','jp'));

        // $cari = $request->id_obrik;

        // $p = Penugasan::where('id_obrik','like',"%".$cari."%");



        $surat = suratTugas::all();
        $penugasan = Penugasan::where('created_at','like','%'.session('tahun').'%')->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();
        $obrik = obrik::all();
        $jp    = jenisPengawasan::all();
        $ir    = Irban::all();

        $filterid_obrik = '';
        $filterid_jenis_pengawasan = '';
        $filterbulan = '';
        $filtertahun = '';
        $filterid_irban = '';

        return view('admin.arsip',compact('surat','penugasan','obrik','jp','ir','filterid_irban','filterid_obrik','filterid_jenis_pengawasan','filterbulan','filtertahun'));

    }

    public function arsipCari(Request $request)
    {
        $filterid_obrik = '';
        $filterid_jenis_pengawasan = '';
        $filterbulan = '';
        $filtertahun = '';
        $filterid_irban = '';

        // $penugasan =Penugasan::when($request->obrik,function($query) use ($request) {
        //     $query->where()
        // })

            $surat = suratTugas::all();
        $penugasan = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik', 'jenis_pengawasans.id as id_jenis_pengawasan','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan','penugasans.tanggalterbitSurat' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->join('jenis_pengawasans', 'jenis_pengawasans.id', '=', 'penugasans.id_jenis_pengawasan')->when($request->obrik,function($query) use ($request){
            $query->where('obriks.nama','like','%'.$request->obrik.'%')->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();
        })->when($request->jenisPengawasan,function($query) use ($request){
            $query->where('jenis_pengawasans.nama','like','%'.$request->jenisPengawasan.'%')->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();
        })->when($request->bulan,function($query) use ($request){
            $query->whereMonth('penugasans.TanggalSurat','=',$request->bulan)->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();
        })->whereYear('TanggalSurat',session('tahun'))->get();

        // if ($request->obrik AND $request->jenisPengawasan AND $request->bulan) {
        //     $surat = suratTugas::all();
        //     $obrik = $request->Obrik;
        //     $jenisPengawasan = $request->jenisPengawasan;
        //     $filterbulan = $request->bulan;
        // }
        // elseif ($request->obrik AND $request->jenisPengawasan) {
        //     $surat = suratTugas::all();
        //     $obrik = $request->Obrik;
        //     $jenisPengawasan = $request->jenisPengawasan;
        //     $penugasan = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik', 'jenis_pengawasans.id as id_jenis_pengawasan','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->join('jenis_pengawasans', 'jenis_pengawasans.id', '=', 'penugasans.id_jenis_pengawasan')->where('obriks.nama','like','%'.$request->obrik.'%')->where('jenis_pengawasans.nama','like','%'.$request->jenisPengawasan.'%')->whereYear('TanggalSurat',session('tahun'))->get();
        // }
        // elseif ($request->obrik AND $request->bulan) {
        //     $surat = suratTugas::all();
        //     $obrik = $request->Obrik;
        //     $filterbulan = $request->bulan;
        //     $penugasan = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->where('obriks.nama','like','%'.$request->obrik.'%')->whereMonth('penugasans.TanggalSurat','=',$request->bulan)->whereYear('TanggalSurat',session('tahun'))->get();
        // }elseif ($request->obrik) {
        //     $surat = suratTugas::all();
        //     $obrik = $request->Obrik;
        //     $penugasan = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->where('obriks.nama','like','%'.$request->obrik.'%')->get();

        // }
        // elseif ($request->bulan) {
        //     $surat = suratTugas::all();
        //     $filterbulan = $request->bulan;
        //     $penugasan = Penugasan::whereMonth('TanggalSurat','=',$request->bulan)->whereYear('TanggalSurat','=',session('tahun'))->orderBy('Tanggalsurat','ASC')->orderBy('TanggalAkhir','ASC')->orderBy('noSurat','ASC')->get();
        // }
        // elseif ($request->jenisPengawasan) {
        //     $surat = suratTugas::all();
        //     $jenisPengawasan = $request->jenisPengawasan;
        //     $penugasan = Penugasan::select('penugasans.id as id', 'jenis_pengawasans.id as id_jenis_pengawasan','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_obrik' )->join('jenis_pengawasans', 'jenis_pengawasans.id', '=', 'penugasans.id_jenis_pengawasan')->where('jenis_pengawasans.nama','like','%'.$request->jenisPengawasan.'%')->get();
        //  }else {
        //     # code...
        //     $surat = suratTugas::all();
        //     $penugasan = Penugasan::join('jenis_pengawasans', 'jenis_pengawasans.id', '=', 'penugasans.id_jenis_pengawasan')->whereYear('TanggalSurat',session('tahun'))->get();
        //  }
        $filterbulan = $request->bulan;
        $filterid_obrik = $request->obrik;
        $filterid_jenis_pengawasan = $request->jenisPengawasan;


        return view('admin.arsip',compact('penugasan','filterbulan','filterid_obrik','filterid_jenis_pengawasan','surat'));
    }

    // public function cek(Request $request)
    // {
    //     return Excel::download(new ExportUser, 'users.xlsx');
    // }

    public function suratBaru (Request $request)
    {
        $x = session('inputan');

        $p = new Penugasan();
        $p->noSurat = $x['noSurat'];
        $p->id_jenis_pengawasan = $x['id_jenis_pengawasan'];
        $p->id_obrik = $x['id_obrik'];
        $p->Tanggalsurat = $x['Tanggalsurat'];
        $p->id_anggaran = $x['id_anggaran'];
        $p->tanggalterbitSurat = $x['tanggalterbitSurat'];
        $p->TanggalAkhir = $x['TanggalAkhir'];
        $p->save();
        $id_penugasan = $p->id;



        foreach ($x['tugas'] as $id_peran => $value ) {

            if (!empty($value['id_karyawan'])) {
                $value['id_penugasan'] = $id_penugasan;
                $value['id_peran'] = $id_peran;
                $this->databaru($value);
        }
    }
        if ($x['anggota']) {
            # code...
            foreach ($x['anggota'] as $id_peran => $value ) {

                foreach ($value as $id_anggota => $data) {

                if (!empty($data['id_karyawan'])) {
                    $data['id_penugasan'] = $id_penugasan;
                    $data['id_peran'] = $id_peran;
                    $this->databaru($data);
                                  }

                }

            }
        }


        return redirect('perjalananDalam')->with('success','Data berhasil di simpan');
    }

    public function suratEdit(Request $request,$id)
    {
        $x = session('inputan');

        // dd($request->all());
        $p = Penugasan::find($id);
        $karyawanlama = $p->surat->pluck('id_karyawan')->toArray();
        $p->noSurat = $x['noSurat'];
        $p->id_jenis_pengawasan = $x['id_jenis_pengawasan'];
        $p->id_obrik = $x['id_obrik'];
        $p->Tanggalsurat = $x['Tanggalsurat'];
        $p->id_anggaran = $x['id_anggaran'];
        $p->tanggalterbitSurat = $x['tanggalterbitSurat'];
        $p->TanggalAkhir = $x['TanggalAkhir'];
        $p->update();


        $id_penugasan = $p->id;

        $karyawanbaru = [];



        foreach ($x['tugas'] as $id_peran => $value ) {

            if (!empty($value['id_karyawan'])) {

                array_push($karyawanbaru,$value['id_karyawan']);
                $value['id_penugasan'] = $id_penugasan;
                $value['id_peran'] = $id_peran;
                $this->databaru($value);
        }
    }
    foreach ($x['ubahtugas'] as $id_suratTugas => $value ) {

        if (!empty($value['id_karyawan'])) {
            array_push($karyawanbaru,$value['id_karyawan']);
            $value['id_penugasan'] = $id_penugasan;
            $value['id_peran'] = $id_peran;
            $this->databaru($value);
    }
}

        if ($x['anggota']) {
            # code...
            foreach ($x['anggota'] as $id_peran => $value ) {
                foreach ($value as $id_anggota => $data) {

                    if (!empty($data['id_karyawan'])) {
                        array_push($karyawanbaru,$data['id_karyawan']);
                        $data['id_penugasan'] = $id_penugasan;
                        $data['id_peran'] = $id_peran;
                        $this->databaru($data);
                                    }

                    }
                }

                }


        foreach ($x['ubahanggota'] as $id_suratTugas => $data) {
            # code...

                if (!empty($data['id_karyawan'])) {
                    array_push($karyawanbaru,$data['id_karyawan']);
                    $data['id_penugasan'] = $id_penugasan;
                    $data['id_peran'] = $id_peran;
                    $this->databaru($data);
                                }

        }
        $karyawanhapus = array_diff($karyawanlama,$karyawanbaru);
        suratTugas::where('id_penugasan',$id_penugasan)->whereIn('id_karyawan',$karyawanhapus)->delete();


        return redirect('perjalananDalam')->with('success','Data berhasil di simpan');
}

 public function databaru(array $value){
    $ta = $value['ta'];
    $tp = $value['tp'];
    $id_karyawan = $value['id_karyawan'];

    $tglBaru = suratTugas::where('id_karyawan',$id_karyawan)->where(function ($query) use ($ta,$tp) {
        $query->whereRaw("'$ta' BETWEEN ta AND tp")->orWhereRaw("'$tp' BETWEEN ta AND tp");
    })->first();

    if ($tglBaru) {
        # code...
        // if ($ta == $tglBaru->ta AND $tp == $tglBaru->tp) {
        //     # code...
        //     // $tglBaru->update([
        //     //     'ta' => null,
        //     //     'tp' => null
        //     // ]);
        //     // return;
        // }
        #mengecek tanggal yang sama
        $taBaru = Carbon::parse($ta)->between($tglBaru->ta,$tglBaru->tp);
        $tpBaru = Carbon::parse($tp)->between($tglBaru->ta,$tglBaru->tp);

        if ($taBaru AND $tpBaru) {
            # code...
            // dd('dobeljobtengah',Carbon::parse($tglBaru->tp)->gt($tp));
             if (Carbon::parse($tglBaru->tp)->gt($tp)) {
             # code...

             }else {
                $tglBaru->update([
                    'tp' => Carbon::parse($ta)->subDay()->format('Y-m-d')
                ]);
                // dd($tglBaru,Carbon::parse($tglBaru->tp)->format('D') == "Sun");
                if ( Carbon::parse($tglBaru->tp)->format('D') == "Sun" ) {

                    $tglBaru->update([
                        'tp' => Carbon::parse($ta)->subDays(3)->format('Y-m-d')
                    ]);

                }
                elseif ( Carbon::parse($tglBaru->tp)->format('D') == "Sat" ) {
                    $tglBaru->update([
                        'tp' => Carbon::parse($ta)->subDays(2)->format('Y-m-d')

                    ]);
                }
            }

        }elseif ($taBaru) {
            # code...
             $tglBaru->update([
                 'tp' => Carbon::parse($ta)->subDay()->format('Y-m-d')
             ]);
            if ( Carbon::parse($tglBaru->tp)->format('D') == "Sun" ) {

                $tglBaru->update([
                    'tp' => Carbon::parse($ta)->subDay(3)->format('Y-m-d')
                ]);

            }
            elseif ( Carbon::parse($tglBaru->tp)->format('D') == "Sat" ) {
                $tglBaru->update([
                    'tp' => Carbon::parse($ta)->subDay(2)->format('Y-m-d')
                ]);
            }
        }elseif ($tpBaru) {
            # code...
            $tglBaru->update([
                'ta' => Carbon::parse($tp)->addDay()->format('Y-m-d')
            ]);

            if ( Carbon::parse($tglBaru->ta)->format('D') == "Sun" ) {

                $tglBaru->update([
                    'ta' => Carbon::parse($tp)->addDay(2)->format('Y-m-d')
                ]);

            }
            elseif ( Carbon::parse($tglBaru->ta)->format('D') == "Sat" ) {
                $tglBaru->update([
                    'ta' => Carbon::parse($tp)->addDay(3)->format('Y-m-d')
                ]);
            }
        }


    }


    $datasurat = null;
    $dataEdit = suratTugas::where('id_penugasan',$value['id_penugasan'])->where('id_karyawan',$value['id_karyawan'])->first();
    if ($dataEdit) {
        # code...
        $dataEdit->update([
            'ta' => $value['ta'],
            'tp' => $value['tp']
        ]);
        $datasurat = $dataEdit;
    }else {
        # code...
        $surat = new suratTugas();
        $surat->id_penugasan = $value['id_penugasan'];
        $surat->id_peran = $value['id_peran'];
        $surat->id_karyawan = $value['id_karyawan'];
        $surat->ta = $value['ta'];
        $surat->tp = $value['tp'];
        $surat->save();
        $datasurat = $surat;
    }
    if (Carbon::parse($datasurat->ta)->gt($datasurat->tp)) {
        // dd($datasurat);
    }
 }

}
