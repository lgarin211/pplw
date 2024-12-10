<?php

namespace App\Http\Controllers;

use App\Models\JenisPengawasan;
use App\Models\Kegiatan;
use App\Models\Obrik;
use App\Models\Pegawai;
use App\Models\Penugasan;
use App\Models\Peran;
use App\Models\Skpd;
use App\Models\suratTugas;
use App\Models\Tahun;
use Illuminate\Http\Request;
use App\Exports\ExportUser;
use App\Models\Irban;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class SuratController extends Controller
{
    public function indexDalam(Request $request)
    {

            if ($request->has('search')) {
                $surat = suratTugas::all();
                $penugasan = Penugasan::where('created_at','like','%'.session('tahun').'%')->where('noSurat	','like','%'.$request->search.'%')->orderBy('id','DESC')->paginate(5);
            }else {
                # code...
                $surat = suratTugas::all();
                $penugasan = Penugasan::where('created_at','like','%'.session('tahun').'%')->orderBy('id','DESC')->paginate(5);
            }

            return view('admin.suratTugasdalam',compact('surat','penugasan'));
    }
    public function CreateperjalananDalam()
    {
        $obrik = Obrik::all();
        $jp    = JenisPengawasan::all();
        $pe    = Pegawai::where('status','Aktif')->get();
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


        $ta = $request->input('ta');
        $tp = $request->input('tp');
        $id_karyawan = $request->input('id_karyawan');
        $s = DB::select("SELECT * FROM surat_tugas WHERE (ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp') AND id_karyawan = '$id_karyawan'  " );


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
            $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
        if ($s[0]->total > 0) {
            $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
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

                    $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
                    if ($s[0]->total > 0) {
                        $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                        $jumlahdobeljob2 += 1;
                        $dobeljob2 .= '  <br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada '.$z[0]->data4.' s/d '.$z[0]->data5.' Apakah Anda tetap ingin memproses penugasan? ';
                    }

                }
            }
        }

        // $dobeljob .= ' <br> Apakah Anda tetap ingin memproses penugasan?';
        // $dobeljob2 = $dobeljob;
        // $jumlahdobeljob2 = $jumlahdobeljob;


        if ($jumlahdobeljob2 > 0) {
            # code...
            return redirect('perjalananDalam_create')->with('danger', $dobeljob2);

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
            $ta = $value['ta'];
            $tp = $value['tp'];
            $id_karyawan = $value['id_karyawan'];

            // $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
            $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
            $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
            if ($s[0]->total > 0) {
                $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan' " );
                $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                        $xy['tp'] = $tpAkhir;
                        suratTugas::where("id",$z[0]->id)->update($xy);

            }

        //    elseif ($s2[0]->total > 0) {
        //         $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
        //         $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

        //        $xy['ta'] = $taAkhir;
        //                 suratTugas::where("id",$z2[0]->id)->update($xy);
        //     }

            $surat = new suratTugas();
            $surat->id_penugasan = $id_penugasan;
            $surat->id_peran = $id_peran;
            $surat->id_karyawan = $value['id_karyawan'];
            $surat->ta = $value['ta'];
            $surat->tp = $value['tp'];
            $surat->save();
        }
    }
        if ($x['anggota']) {
            # code...
            foreach ($x['anggota'] as $id_peran => $value ) {

                foreach ($value as $id_anggota => $data) {
                if (!empty($data['id_karyawan'])) {
                    $ta = $data['ta'];
                    $tp = $data['tp'];
                    $id_karyawan = $data['id_karyawan'];
                    $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
                    $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
                   if ($s[0]->total > 0) {
                   $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan' " );
                 $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                        $xy['tp'] = $tpAkhir;
                        suratTugas::where("id",$z[0]->id)->update($xy);

            }

        //    elseif ($s2[0]->total > 0) {
        //         $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
        //         $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

        //        $xy['ta'] = $taAkhir;
        //                 suratTugas::where("id",$z2[0]->id)->update($xy);
        //     }

            $surat = new suratTugas();
            $surat->id_penugasan = $id_penugasan;
            $surat->id_peran = $id_peran;
            $surat->id_karyawan = $data['id_karyawan'];
            $surat->ta = $data['ta'];
            $surat->tp = $data['tp'];
            $surat->save();
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
        $surat = suratTugas::where('id_penugasan',$id)->get();
        return view('admin.template_surat',compact('st','skpd','surat'));
    }

    public function suratperintah($id_penugasan)
    {
        $st = Penugasan::first();
        $skpd = skpd::first();
        $k = kegiatan::first();
        $surat = suratTugas::where('id_penugasan',$id_penugasan)->get();

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



        $total = 0;

        foreach ($surat as $key => $v) {
            $sampai = strtotime($v->tp); // or your date as well
            $dari = strtotime($v->ta);
            $datediff = $sampai - $dari;
            if (empty($sampai)) {
                  $jumlahHari = 0;
                } else {
                  $jumlahHari =  round($datediff / (60 * 60 * 24))+1;
                }
            $total += ($jumlahHari *  $v->peran->tarif) ;
        }
        return view('admin.suratDinas',compact('st','skpd','k','surat','taAkhir','tpAkhir'));

    }

    public function sppd($id_penugasan)
    {
        $skpd = skpd::first();
        $st = Penugasan::first();
        $surat = suratTugas::where('id_penugasan',$id_penugasan)->get();
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


        #jika ada tanggal yang bentrok maka tanggal sebelumnya diubah

        $request->session()->put('inputan', $inputan);

        $p = Penugasan::find($id);
        $p->noSurat = $request->input('noSurat');
        $p->id_jenis_pengawasan = $request->input('id_jenis_pengawasan');
        $p->id_obrik = $request->input('id_obrik');
        $p->Tanggalsurat = $request->input('Tanggalsurat');
        $p->id_anggaran = $request->input('id_anggaran');
        $p->tanggalterbitSurat = $request->input('tanggalterbitSurat');
        $p->TanggalAkhir = $request->input('TanggalAkhir');


        $p->update();



        $id_penugasan = $p->id;

        //yg errorr skrip mengganti item nama tim yang terdiri dari penanggung jawab, anggota, dll.
        $st = suratTugas::where('id_penugasan',$id)->get();

       foreach ($request->input('tugas') as $id_peran => $value ) {
            if (!empty($value['id_karyawan'])) {
            $ta = $value['ta'];
            $tp = $value['tp'];
            $id_karyawan = $value['id_karyawan'];
            $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE (ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp') AND id_karyawan = '$id_karyawan'" );
            $surat = new suratTugas();
            $surat->id_penugasan = $id_penugasan;
            $surat->id_peran = $id_peran;
            $surat->id_karyawan = $value['id_karyawan'];
            $surat->ta = $value['ta'];
            $surat->tp = $value['tp'];
            $surat->save();
        }

    }

        if ($request->input('ubahtugas')) {
            # code...
            foreach ($request->input('ubahtugas') as $id_penugasan => $value)
            {
                $data['id_karyawan'] = $value['id_karyawan'];
                $data['ta'] = $value['ta'];
                $data['tp'] = $value['tp'];
                suratTugas::where('id',$id_penugasan)->update($data);
            }
        }

        if ($request->input('anggota')) {
            # code...
            foreach ($request->input('anggota') as $id_peran => $value ) {

                foreach ($value as $id_anggota => $data) {
                    if (!empty($data['id_karyawan'])) {
                    $ta = $data['ta'];
                    $tp = $data['tp'];
                    $id_karyawan = $data['id_karyawan'];
                    $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE (ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp') AND id_karyawan = '$id_karyawan'" );
                    // if ($s[0]->total == 0) {
                    // echo "<script> alert('data ganda') </script>";
                    // exit();
                    // }
                    // print_r($data);
                    $surat = new suratTugas();
                    $surat->id_penugasan = $id;
                    $surat->id_peran = $id_peran;
                    $surat->id_karyawan = $data['id_karyawan'];
                    $surat->ta = $data['ta'];
                    $surat->tp = $data['tp'];
                    $surat->save();
                }

                }

            }
        }

            if ($request->input('ubahanggota')) {
            # code...
            foreach ($request->input('ubahanggota') as $id_penugasan => $data ) {


                if (!empty($data['id_karyawan'])) {
                     $dataanggota['id_karyawan'] = $data['id_karyawan'];
                    $dataanggota['ta'] = $data['ta'];
                    $dataanggota['tp'] = $data['tp'];
                    suratTugas::where('id',$id_penugasan)->update($dataanggota);
                }


          }
         }

         $ta = $request->input('ta');
         $tp = $request->input('tp');
         $id_karyawan = $request->input('id_karyawan');
         $s = DB::select("SELECT * FROM surat_tugas WHERE (ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp') AND id_karyawan = '$id_karyawan'  " );

         $dobeljob = 'Terdapat pegawai yang sudah mempunyai jadwal penugasan antara lain:';
         $jumlahdobeljob = 0;
         foreach ($request->input('tugas') as $id_peran => $value) {
             # code...
             $ta = $value['ta'];
             $tp = $value['tp'];
             $id_karyawan = $value['id_karyawan'];
             $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
         if ($s[0]->total > 0) {
             $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                 $jumlahdobeljob += 1;
                 $dobeljob .= '<br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada tanggal '.$z[0]->data4.' s/d '.$z[0]->data5.'.';
             }

         }
         foreach ($request->input('ubahtugas') as $id_suratTugas => $value) {
             # code...
             $ta = $value['ta'];
             $tp = $value['tp'];
             $id_karyawan = $value['id_karyawan'];
             $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
         if ($s[0]->total > 0) {
             $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                 $jumlahdobeljob += 1;
                 $dobeljob .= '<br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada tanggal '.$z[0]->data4.' s/d '.$z[0]->data5.'.';
             }

         }

         $dobeljob .= ' <br> Apakah Anda tetap ingin memproses penugasan?';
         $dobeljob2 = $dobeljob;
         $jumlahdobeljob2 = $jumlahdobeljob;
         if ($request->input('anggota')) {
             # code...
             foreach ($request->input('anggota') as $id_peran => $value ) {

                 foreach ($value as $id_anggota => $data) {
                    if (!empty($data['id_karyawan'])) {
                        $ta = $data['ta'];
                        $tp = $data['tp'];
                        $id_karyawan = $data['id_karyawan'];

                        $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
                        if ($s[0]->total > 0) {
                            $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                            $jumlahdobeljob2 += 1;
                            $dobeljob2 .= '  <br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada '.$z[0]->data4.' s/d '.$z[0]->data5.' Apakah Anda tetap ingin memproses penugasan? ';
                        }

                    }
                }

             }
         }

         foreach ($request->input('ubahanggota') as $id_suratTugas => $value) {
             # code...
             if (!empty($data['id_karyawan'])) {
                $ta = $data['ta'];
                $tp = $data['tp'];
                $id_karyawan = $data['id_karyawan'];

                $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
                if ($s[0]->total > 0) {
                    $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                    $jumlahdobeljob2 += 1;
                    $dobeljob2 .= '  <br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada '.$z[0]->data4.' s/d '.$z[0]->data5.' Apakah Anda tetap ingin memproses penugasan? ';
                }

            }

         }

        //  $dobeljob .= ' <br> Apakah Anda tetap ingin memproses penugasan?';
        //  $dobeljob2 = $dobeljob;
        //  $jumlahdobeljob2 = $jumlahdobeljob;

         foreach ($request->input('anggota') as $id_peran => $value ) {

            foreach ($value as $id_anggota => $data) {
                if (!empty($data['id_karyawan'])) {
                    $ta = $data['ta'];
                    $tp = $data['tp'];
                    $id_karyawan = $data['id_karyawan'];

                    $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
                    if ($s[0]->total > 0) {
                        $z = DB::select("SELECT pegawais.nama_karyawan AS data1, jenis_pengawasans.nama AS data2, obriks.nama AS data3, surat_tugas.ta AS data4, surat_tugas.tp AS data5 FROM  surat_tugas JOIN pegawais ON pegawais.id = surat_tugas.id_karyawan JOIN penugasans ON penugasans.id = surat_tugas.id_penugasan JOIN jenis_pengawasans ON jenis_pengawasans.id = penugasans.id_jenis_pengawasan JOIN obriks ON obriks.id = penugasans.id_obrik WHERE ((ta <= '$ta' AND tp >= '$ta') OR (ta <= '$tp' AND tp >= '$tp')) AND surat_tugas.id_karyawan = '$id_karyawan'" );
                        $jumlahdobeljob2 += 1;
                        $dobeljob2 .= '  <br> - pegawai '.$z[0]->data1.' sudah di tugaskan '.$z[0]->data2.' ke  '.$z[0]->data3.' pada '.$z[0]->data4.' s/d '.$z[0]->data5.' Apakah Anda tetap ingin memproses penugasan? ';
                    }

                }
            }

            if ($jumlahdobeljob2 > 0) {
                # code...
                return redirect('perjalanan_edit/'.$id)->with('danger', $dobeljob2);

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
                 $ta = $value['ta'];
                 $tp = $value['tp'];
                 $id_karyawan = $value['id_karyawan'];

                 $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
                 $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
                 if ($s[0]->total > 0) {
                     $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan' " );
                     $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                             $xy['tp'] = $tpAkhir;
                             suratTugas::where("id",$z[0]->id)->update($xy);

                 }

                elseif ($s2[0]->total > 0) {
                    $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
                    $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

                   $xy['ta'] = $taAkhir;
                            suratTugas::where("id",$z2[0]->id)->update($xy);
                 }

                 $surat = new suratTugas();
                 $surat->id_penugasan = $id_penugasan;
                 $surat->id_peran = $id_peran;
                 $surat->id_karyawan = $value['id_karyawan'];
                 $surat->ta = $value['ta'];
                 $surat->tp = $value['tp'];
                 $surat->save();
             }
         }
             if ($x['anggota']) {
                 # code...
                 foreach ($x['anggota'] as $id_peran => $value ) {

                     foreach ($value as $id_anggota => $data) {
                     if (!empty($data['id_karyawan'])) {
                        $ta = $data['ta'];
                        $tp = $data['tp'];
                        $id_karyawan = $data['id_karyawan'];
                        $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
                        $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
                       if ($s[0]->total > 0) {
                       $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan' " );
                     $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                            $xy['tp'] = $tpAkhir;
                            suratTugas::where("id",$z[0]->id)->update($xy);

                }

               elseif ($s2[0]->total > 0) {
                    $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
                    $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

                   $xy['ta'] = $taAkhir;
                            suratTugas::where("id",$z2[0]->id)->update($xy);
                }

                $surat = new suratTugas();
                $surat->id_penugasan = $id_penugasan;
                $surat->id_peran = $id_peran;
                $surat->id_karyawan = $data['id_karyawan'];
                $surat->ta = $data['ta'];
                $surat->tp = $data['tp'];
                $surat->save();
                     }

                     }

                 }
             }



        return redirect('perjalananDalam')->with('info','Data berhasil di Edit');
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
        $penugasan = Penugasan::where('created_at','like','%'.session('tahun').'%')->orderBy('id','DESC')->get();
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

        if($request->id_obrik AND $request->id_jenis_pengawasan AND $request->bulan AND $request->tahun AND $request->id_irban) {
            $obrik = Obrik::all();
            $jp    = jenisPengawasan::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $penugasan = Penugasan::where('id_obrik','like','%'.$request->id_obrik.'%')->where('id_jenis_pengawasan','like','%'.$request->id_jenis_pengawasan.'%')->whereMonth('created_at','=',$request->bulan)->whereYear('created_at','=',session('tahun'))->get();

        }elseif ($request->id_obrik AND $request->id_jenis_pengawasan AND $request->tahun) {
            $obrik = Obrik::all();
            $jp    = jenisPengawasan::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $penugasan = Penugasan::where('id_obrik','like','%'.$request->id_obrik.'%')->where('id_jenis_pengawasan','like','%'.$request->id_jenis_pengawasan.'%')->whereYear('created_at','=',session('tahun'))->get();
        }elseif ($request->id_obrik AND $request->id_jenis_pengawasan AND $request->bulan) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $jp    = jenisPengawasan::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $penugasan = Penugasan::where('id_obrik','like','%'.$request->id_obrik.'%')->where('id_jenis_pengawasan','like','%'.$request->id_jenis_pengawasan.'%')->whereMonth('created_at','=',$request->bulan)->get();
        }elseif ($request->id_obrik AND $request->tahun) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $jp    = jenisPengawasan::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $penugasan = Penugasan::where('id_obrik','like','%'.$request->id_obrik.'%')->whereYear('created_at','=',session('tahun'))->get();
        }elseif ($request->id_obrik AND $request->bulan) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $jp    = jenisPengawasan::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $penugasan = Penugasan::where('id_obrik','like','%'.$request->id_obrik.'%')->whereMonth('created_at','=',$request->bulan)->get();
        }elseif ($request->id_obrik AND $request->id_jenis_pengawasan) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $jp    = jenisPengawasan::all();
            $penugasan = Penugasan::where('id_obrik','like','%'.$request->id_obrik.'%')->where('id_jenis_pengawasan','like','%'.$request->id_jenis_pengawasan.'%')->get();
        }elseif ($request->tahun) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $jp    = jenisPengawasan::all();
            $penugasan = Penugasan::whereYear('created_at','=',session('tahun'))->get();
        }elseif ($request->bulan) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $jp    = jenisPengawasan::all();
            $penugasan = Penugasan::whereMonth('created_at','=',$request->bulan)->get();
        }elseif ($request->id_jenis_pengawasan) {
           $penugasan = Penugasan::all();
            $obrik = Obrik::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $jp    = jenisPengawasan::all();
            $penugasan = Penugasan::where('id_jenis_pengawasan','like','%'.$request->id_jenis_pengawasan.'%')->get();
        }elseif ($request->id_obrik) {
            // $surat = suratTugas::all();
            $obrik = Obrik::all();
            $ir    = Irban::all();
            $surat = suratTugas::all();
            $jp    = jenisPengawasan::all();
            $penugasan = Penugasan::where('id_obrik','like','%'.$request->id_obrik.'%')->get();
        }

        $filterid_obrik = $request->id_obrik;
        $filterid_jenis_pengawasan = $request->id_jenis_pengawasan;
        $filterbulan = $request->bulan;
        $filtertahun = $request->tahun;
        $filterid_irban = $request->id_irban;


        return view('admin.arsip',compact('surat','penugasan','obrik','ir','jp', 'filterid_obrik','filterid_jenis_pengawasan',
    'filterbulan','filtertahun','filterid_irban'));
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
            $ta = $value['ta'];
            $tp = $value['tp'];
            $id_karyawan = $value['id_karyawan'];

            $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
            $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
            if ($s[0]->total > 0) {
                $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan' " );
                $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                        $xy['tp'] = $tpAkhir;
                        suratTugas::where("id",$z[0]->id)->update($xy);

            }

        //    elseif ($s2[0]->total > 0) {
        //         $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
        //         $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

        //        $xy['ta'] = $taAkhir;
        //                 suratTugas::where("id",$z2[0]->id)->update($xy);
        //     }

            $surat = new suratTugas();
            $surat->id_penugasan = $id_penugasan;
            $surat->id_peran = $id_peran;
            $surat->id_karyawan = $value['id_karyawan'];
            $surat->ta = $value['ta'];
            $surat->tp = $value['tp'];
            $surat->save();
        }
    }
        if ($x['anggota']) {
            # code...
            foreach ($x['anggota'] as $id_peran => $value ) {

                foreach ($value as $id_anggota => $data) {
                if (!empty($data['id_karyawan'])) {
                    $ta = $data['ta'];
                    $tp = $data['tp'];
                    $id_karyawan = $data['id_karyawan'];
                    $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
                    $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
                    if ($s[0]->total > 0) {
                        $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan' " );
                        $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                                $xy['tp'] = $tpAkhir;
                                suratTugas::where("id",$z[0]->id)->update($xy);

                    }

                //    elseif ($s2[0]->total > 0) {
                //         $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
                //         $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

                //        $xy['ta'] = $taAkhir;
                //                 suratTugas::where("id",$z2[0]->id)->update($xy);
                //     }

                    $surat = new suratTugas();
                    $surat->id_penugasan = $id_penugasan;
                    $surat->id_peran = $id_peran;
                    $surat->id_karyawan = $data['id_karyawan'];
                    $surat->ta = $data['ta'];
                    $surat->tp = $data['tp'];
                    $surat->save();
                }

                }

            }
        }


        return redirect('perjalananDalam')->with('success','Data berhasil di simpan');
    }

    public function suratEdit(Request $request, $id)
    {
        $x = session('inputan');

        $p = Penugasan::find($id);
        $p->noSurat = $request->input('noSurat');
        $p->id_jenis_pengawasan = $request->input('id_jenis_pengawasan');
        $p->id_obrik = $request->input('id_obrik');
        $p->Tanggalsurat = $request->input('Tanggalsurat');
        $p->id_anggaran = $request->input('id_anggaran');
        $p->tanggalterbitSurat = $request->input('tanggalterbitSurat');
        $p->TanggalAkhir = $request->input('TanggalAkhir');
        $p->update();
        $id_penugasan = $p->id;

        foreach ($x['tugas'] as $id_peran => $value ) {
            if (!empty($value['id_karyawan'])) {
                $ta = $value['ta'];
                $tp = $value['tp'];
                $id_karyawan = $value['id_karyawan'];

                           // $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
                           $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
                $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
                if ($s[0]->total > 0) {
                    $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
                    $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                            $xy['tp'] = $tpAkhir;
                            suratTugas::where("id",$z[0]->id)->update($xy);

                }

               elseif ($s2[0]->total > 0) {
                    $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
                    $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

                   $xy['ta'] = $taAkhir;
                            suratTugas::where("id",$z2[0]->id)->update($xy);
                }

                $surat = new suratTugas();
                $surat->id_penugasan = $id_penugasan;
                $surat->id_peran = $id_peran;
                $surat->id_karyawan = $value['id_karyawan'];
                $surat->ta = $value['ta'];
                $surat->tp = $value['tp'];
                $surat->save();
        }
    }
    foreach ($x['ubahtugas'] as $id_peran => $value ) {
        if (!empty($value['id_karyawan'])) {
            $ta = $value['ta'];
            $tp = $value['tp'];
            $id_karyawan = $value['id_karyawan'];

                       // $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
                       $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
            $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
            if ($s[0]->total > 0) {
                $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE  ta <= '$ta' AND tp >= '$ta' AND id_karyawan = '$id_karyawan' " );
                $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                        $xy['tp'] = $tpAkhir;
                        suratTugas::where("id",$z[0]->id)->update($xy);

            }

           elseif ($s2[0]->total > 0) {
                $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
                $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

               $xy['ta'] = $taAkhir;
                        suratTugas::where("id",$z2[0]->id)->update($xy);
            }

            $surat = new suratTugas();
            $surat->id_penugasan = $id_penugasan;
            $surat->id_peran = $id_peran;
            $surat->id_karyawan = $value['id_karyawan'];
            $surat->ta = $value['ta'];
            $surat->tp = $value['tp'];
            $surat->save();
    }
}         if ($x->input('anggota')) {
    # code...
    foreach ($x->input('anggota') as $id_peran => $value ) {

        foreach ($value as $id_anggota => $data) {
            if (!empty($data['id_karyawan'])) {
                $ta = $data['ta'];
                $tp = $data['tp'];
                $id_karyawan = $data['id_karyawan'];
                $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
                $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
               if ($s[0]->total > 0) {
               $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan' " );
             $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

                    $xy['tp'] = $tpAkhir;
                    suratTugas::where("id",$z[0]->id)->update($xy);

        }

       elseif ($s2[0]->total > 0) {
            $z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
            $taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

           $xy['ta'] = $taAkhir;
                    suratTugas::where("id",$z2[0]->id)->update($xy);
        }

        $surat = new suratTugas();
        $surat->id_penugasan = $id_penugasan;
        $surat->id_peran = $id_peran;
        $surat->id_karyawan = $data['id_karyawan'];
        $surat->ta = $data['ta'];
        $surat->tp = $data['tp'];
        $surat->save();
            }
        }

        }

}

foreach ($x->input('ubahanggota') as $id_suratTugas => $value) {
    # code...
    $ta = $data['ta'];
    $tp = $data['tp'];
    $id_karyawan = $data['id_karyawan'];
    $s = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan'" );
    $s2 = DB::select("SELECT COUNT(id) AS total FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan'  " );
   if ($s[0]->total > 0) {
   $z = DB::select("SELECT ta, tp, id FROM  surat_tugas WHERE ((ta <= '$ta' AND tp <= '$ta') OR (ta <= '$tp' AND tp <= '$tp')) AND id_karyawan = '$id_karyawan' " );
 $tpAkhir = date('Y-m-d',strtotime($ta.' -1 day'));

        $xy['tp'] = $tpAkhir;
        suratTugas::where("id",$z[0]->id)->update($xy);

}

elseif ($s2[0]->total > 0) {
$z2 = DB::select("SELECT ta, tp,id FROM  surat_tugas WHERE  ta <= '$tp' AND tp >= '$tp' AND id_karyawan = '$id_karyawan' " );
$taAkhir = date('Y-m-d',strtotime($tp.' +1 day'));

$xy['ta'] = $taAkhir;
        suratTugas::where("id",$z2[0]->id)->update($xy);
}

$surat = new suratTugas();
$surat->id_penugasan = $id_penugasan;
$surat->id_peran = $id_peran;
$surat->id_karyawan = $data['id_karyawan'];
$surat->ta = $data['ta'];
$surat->tp = $data['tp'];
$surat->save();
}


        return redirect('perjalananDalam')->with('success','Data berhasil di simpan');
}
}
