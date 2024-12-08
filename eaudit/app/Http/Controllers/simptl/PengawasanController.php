<?php

namespace App\Http\Controllers\simptl;

use Carbon\Carbon;
use App\Models\File;
use App\Models\User;
use App\Models\Obrik;
use App\Models\Pegawai;
use App\Models\Kegiatan;
use App\Models\Penugasan;
use App\Models\JadwalLain;
use App\Models\Pengawasan;
use App\Models\JadwalLibur;
use App\Models\JenisTemuan;
use Illuminate\Http\Request;
use App\Models\JenisPengawasan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PengawasanController extends Controller
{
    //
    public function index()
    {
        return view('simptl.index');
    }
    public function tes()
    {
        $user =  User::find(session("id"));

        $pengawasan = Pengawasan::join('penugasans', 'penugasans.id', '=', 'pengawasans.id_penugasan')->where('penugasans.id_obrik',$user->id_obrik)->get();

        dump($pengawasan);

        // return view('simptl.tes',compact('pengawasan'));



    }
    public function loginAdmin(Request $request)
    {
        // dd($request->all());
        $username = $request->username;
        $password = $request->password;

        $cekuser = User::where("username", $username)->first();

        if (empty($cekuser)) {
            return redirect("/");
        } else {
            // if (Hash::check($password, $cekuser->password)) {

            //     $request->session()->put("id", $cekuser->id);
            //     $request->session()->put("name", $cekuser->name);
            //     $request->session()->put("username ", $cekuser->username );
            //     $request->session()->put("tahun", date('Y'));
            //     // dd($cekuser);

            //     return redirect('index');



            // }

             if (Hash::check($password, $cekuser->password)) {

                $request->session()->put("id", $cekuser->id);
                // $request->session()->put("name", $cekuser->name);
                $request->session()->put("username", $cekuser->username);
                // $request->session()->put("tahun", date('Y'));
                $request->session()->put("level", $cekuser->level);
                $request->session()->put("tahun", date('Y'));
                // dd($cekuser);

                if ($cekuser->level == 'admin2') {
                    return redirect('pkpt');
                }
            } else {
                return redirect('/');
            }


        }
    }
    public function pkpt(Request $request)
    {
        $penugasan      = Penugasan::all();
        $jp             = JenisPengawasan::all();
        $obrik          = Obrik::all();
        $pengawasan     = Pengawasan::where('created_at','like','%'.session('tahun').'%')->orderBy('created_at','DESC')->paginate(5);
        return view('simptl.pkpt',compact('pengawasan','penugasan','jp','obrik'));
    }

    public function pkptcreate($id)
    {
        $penugasan = Penugasan::where('id',$id)->first();
        return view('simptl.pkpt_create',compact('penugasan'));
     }
    public function pkptedit($id)
    {
        $surat = Pengawasan::where('id',$id)->first();
        return view('simptl.pkpt_edit',compact('surat'));
    }
    public function pkptstore(Request $request,$id)
    {
        $penugasan = Penugasan::find($id);
        $input['id_penugasan'] = $penugasan->id;
        $mlebu['id_obrik'] = $penugasan->id_obrik;

        $input['nama'] = $request->input('nama');
        $input['tipe'] = $request->input('tipe');
        $input['jenis'] = $request->input('jenis');
        $input['wilayah'] = $request->input('wilayah');
        $input['pemeriksa'] = $request->input('pemeriksa');
        $input['status_LHP'] = "Belum Jadi";
        $p = Pengawasan::create($input);
        User::where('level', 'obrik')->update($mlebu);



        return redirect('simptl/pkpt');
    }
    public function pkptupdate(Request $request,$id)
    {
        $obrik = Pengawasan::find($id);
        $obrik->nama = $request->input('nama');
        $obrik->tipe = $request->input('tipe');
        $obrik->jenis = $request->input('jenis');
        $obrik->wilayah = $request->input('wilayah');
        $obrik->pemeriksa = $request->input('pemeriksa');
        $obrik->save();
        return redirect('pkpt');
    }
    public function tipeA()
    {
        $Pengawasan     = Pengawasan::where('tipe','=','Rekomendasi')->where('created_at','like','%'.session('tahun').'%')->get();
        $jt = JenisTemuan::all();
        return view('simptl.tipeA',compact('Pengawasan','jt'));
    }
    public function tipeAedit($id)
    {
        $surat = Pengawasan::find($id);
        $jt = JenisTemuan::where('id_pengawasans',$id)->whereNull('id_parent')->get();
        return view('simptl.tipeA_edit',compact('jt','surat'));
    }
    public function tipeAstore(Request $request,$id)
    {

        $surat = Pengawasan::find($id);
        $id_pengawasans = $surat->id;

        $id_pengawasans   =$id_pengawasans;
        $rekomendasi      =$request->rekomendasi;
        $keterangan       =$request->keterangan;
        // $kode_rekomendasi =$request->kode_rekomendasi;
        $pengembalian     =$request->pengembalian;

        DB::beginTransaction();
        try {
            $datalama = JenisTemuan::where('id_pengawasans',$id)->pluck('id')->toArray();
            foreach ($request->tipeA as $key => $value) {
                # code...
                    $datasave = [
                        'id_pengawasans' => $id_pengawasans,
                        'rekomendasi' => $value['rekomendasi'],
                        'keterangan' => $value['keterangan'],
                        // 'kode_rekomendasi' => $value['kode_rekomendasi'],
                        'pengembalian' => $value['pengembalian']
                    ];

                    if ($value['rekomendasi'] != '' AND $value['keterangan'] != '') {
                        # code...
                        $data = JenisTemuan::create($datasave);
                    }

                    if (isset($value['sub'])) {
                        # code...
                        foreach ($value['sub'] as $sub) {
                            # code...
                            $datasave = [
                                'id_pengawasans' => $id_pengawasans,
                                'rekomendasi' => $sub['rekomendasi'],
                                'keterangan' => $sub['keterangan'],
                                // 'kode_rekomendasi' => $sub['kode_rekomendasi'],
                                'pengembalian' => $sub['pengembalian'],
                                'id_parent' => $data->id
                            ];

                            $data1 = JenisTemuan::create($datasave);


                            if (isset($sub['sub'])) {
                                # code...
                                foreach ($sub['sub'] as $sub2) {
                                    # code...
                                    $datasave = [
                                        'id_pengawasans' => $id_pengawasans,
                                        'rekomendasi' => $sub2['rekomendasi'],
                                        'keterangan' => $sub2['keterangan'],
                                        // 'kode_rekomendasi' => $sub2['kode_rekomendasi'],
                                        'pengembalian' => $sub2['pengembalian'],
                                        'id_parent' => $data1->id
                                    ];

                                    $data2 = JenisTemuan::create($datasave);
                                }
                            }
                        }

                    }
            }



            $databaru = [];

            $ubahTipeA = $request->ubahTipeA ?? array();
            // dump($ubahTipeA,$request->tipeA);
            // dd($ubahTipeA);
            foreach ($ubahTipeA as $ubahdata) {
                //LEVEL1
                if (isset($ubahdata['id'])) {
                    # code...
                    array_push($databaru,$ubahdata['id']);
                    if ($ubahdata['rekomendasi']) {
                        # code...
                        $data = JenisTemuan::where('id',$ubahdata['id'])->update([
                            'rekomendasi' => $ubahdata['rekomendasi'],
                            'keterangan' => $ubahdata['keterangan'],
                            // 'kode_rekomendasi' => $ubahdata['kode_rekomendasi'],
                            'pengembalian' => $ubahdata['pengembalian'],
                        ]);
                    }
                }
                # code...
                // dump('level1',JenisTemuan::whereNull('id_pengawasans')->pluck('id')->toArray());
                if (isset($ubahdata['sub'])) {
                    # code...
                    //Level2
                    foreach ($ubahdata['sub'] as $ubahsub1) {

                        $id = $ubahsub1['id'] ?? null;
                        array_push($databaru,$id);
                        $parentid = $ubahsub1['parentid'] ?? null;
                        $cekdata = JenisTemuan::where('id',$id)->first();
                            if ($cekdata) {
                                    # code...
                                $cekdata->update([
                                        'rekomendasi' => $ubahsub1['rekomendasi'],
                                        'keterangan' => $ubahsub1['keterangan'],
                                        // 'kode_rekomendasi' => $ubahsub1['kode_rekomendasi'],
                                        'pengembalian' => $ubahsub1['pengembalian'],
                                    ]);
                                    }else {
                                if ($ubahsub1['rekomendasi'] AND !$id) {
                                    JenisTemuan::create([
                                    'id_pengawasans' => $id_pengawasans,
                                    'rekomendasi' => $ubahsub1['rekomendasi'],
                                    'keterangan' => $ubahsub1['keterangan'],
                                    // 'kode_rekomendasi' => $ubahsub1['kode_rekomendasi'],
                                    'pengembalian' => $ubahsub1['pengembalian'],
                                    'id_parent' => $parentid,
                                    ]);
                                }
                                }
                                // dump('level2',JenisTemuan::whereNull('id_pengawasans')->pluck('id')->toArray());

                        if (isset($ubahsub1['sub'])) {
                            # code...
                            //Level3
                            foreach ($ubahsub1['sub'] as $ubahsub2) {
                                # code...
                                $id = $ubahsub2['id'] ?? null;
                                array_push($databaru,$id);
                                $parentid = $ubahsub2['parentid'] ?? null;
                                $cekdata = JenisTemuan::where('id',$id)->first();
                                if ($cekdata) {
                                    # code...
                                   $cekdata->update([
                                        'rekomendasi' => $ubahsub2['rekomendasi'],
                                        'keterangan' => $ubahsub2['keterangan'],
                                        // 'kode_rekomendasi' => $sub2['kode_rekomendasi'],
                                        'pengembalian' => $ubahsub2['pengembalian'],
                                    ]);

                                }else {
                                    if ($ubahsub2['rekomendasi'] AND !$id) {
                                    JenisTemuan::create([
                                    'id_pengawasans' => $id_pengawasans,
                                    'rekomendasi' => $ubahsub2['rekomendasi'],
                                    'keterangan' => $ubahsub2['keterangan'],
                                    // 'kode_rekomendasi' => $ubahsub2['kode_rekomendasi'],
                                    'pengembalian' => $ubahsub2['pengembalian'],
                                    'id_parent' => $parentid,
                                    ]);
                                }
                                }
                            }
                        }
                        // dump('level3',JenisTemuan::whereNull('id_pengawasans')->pluck('id')->toArray());
                    }
                }
            }
            $datahapus = array_diff($datalama,$databaru);
            // dd($datalama,$databaru,$datahapus);
            // JenisTemuan::whereIn('id',$datahapus)->delete();
            JenisTemuan::destroy($datahapus);
            // dump('hapus',JenisTemuan::whereNull('id_pengawasans')->pluck('id')->toArray());
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            dd($th->getMessage(),$th->getLine());
        }



            // for ($i=0; $i < count($tipeA) ; $i++) {
            //     # code...
            //     $datasave = [
            //         'id_pengawasans' => $id_pengawasans,
            //         'rekomendasi' => $rekomendasi[$i],
            //         'keterangan' => $keterangan[$i],
            //         'kode_rekomendasi' => $kode_rekomendasi[$i],
            //         'pengembalian' => $pengembalian[$i]
            //     ];

            //     DB::table('jenis_temuans')->insert($datasave);
            //     }
            // dump('commit',JenisTemuan::whereNull('id_pengawasans')->pluck('id')->toArray());
            // dd('stop');

            $surat->status_LHP = "Sedang Proses";
            $surat->save();
                return redirect('simptl/tipeA')->with('success','Data berhasil di simpan');

    }
    public function tipeAshow(Request $request,$id)
    {
        $surat = Pengawasan::find($id);
        $jt = JenisTemuan::where('id_pengawasans',$id)->whereNull('id_parent')->get();
        return view('simptl.tipeA_detail',compact('surat','jt'));
    }
    // public function tipeAHapus()
    // {
    //     return view('simptl.tipeA_create');
    // }
    public function tipeB()
    {
        $Pengawasan     = Pengawasan::where('tipe','=','TemuandanRekomendasi')->where('created_at','like','%'.session('tahun').'%')->get();

        $jt = JenisTemuan::all();

        return view('simptl.tipeC',compact('Pengawasan','jt'));
    }

    public function tipeBedit($id)
    {

        $surat = Pengawasan::find($id);
        $jt = JenisTemuan::where('id_pengawasans',$id)->whereNull('id_parent')->get()->groupBy('kode_temuan');
        return view('simptl.tipeB_edit',compact('jt','surat'));
    }
    public function tipeBstore(Request $request,$id)
    {

        // dd($request->all());
        $surat = Pengawasan::find($id);
        $id_pengawasans = $surat->id;

        DB::beginTransaction();
        try {
            $datalama = JenisTemuan::where('id_pengawasans',$id)->pluck('id')->toArray();

            // dd($request->temuan,$request->edittemuan);
        foreach ($request->temuan as  $item) {
            // dd($request->temuan);
            # code...
            //validasi data terisi

            foreach ($item['rekomendasi'] as $value) {
                # code...
                if ($value['kode_rekomendasi'] AND $value['rekomendasi'] AND $value['keterangan'] ) {
                    # code...
                    $parent = JenisTemuan::create([
                        'id_pengawasans' => $id_pengawasans,
                        'nama_temuan' => $item['nama_temuan'],
                        'kode_temuan' => $item['kode_temuan'],
                        'rekomendasi' => $value['rekomendasi'],
                        'kode_rekomendasi' => $value['kode_rekomendasi'],
                        'pengembalian' => $value['pengembalian'],
                        'keterangan' => $value['keterangan'],

                    ]);
                }
                if (isset($value['sub'])) {
                    # code...
                    foreach ($value['sub'] as $row) {
                        if ($row['kode_rekomendasi'] AND $row['rekomendasi'] AND $row['keterangan']) {
                            # code...
                            # code...
                            $parentsub = JenisTemuan::create([
                                'id_parent' => $parent->id,
                                'id_pengawasans' => $id_pengawasans,
                                'nama_temuan' => $item['nama_temuan'],
                                'kode_temuan' => $item['kode_temuan'],
                                'rekomendasi' => $row['rekomendasi'],
                                'kode_rekomendasi' => $row['kode_rekomendasi'],
                                'pengembalian' => $row['pengembalian'],
                                'keterangan' => $row['keterangan'],

                            ]);
                        }

                        if (isset($row['sub'])) {
                            # code...
                            foreach ($row['sub'] as $x) {
                                if ($x['kode_rekomendasi'] AND $x['rekomendasi'] AND $x['keterangan']) {

                                    $parentsub1 = JenisTemuan::create([
                                        'id_parent' => $parentsub->id,
                                        'id_pengawasans' => $id_pengawasans,
                                        'nama_temuan' => $item['nama_temuan'],
                                        'kode_temuan' => $item['kode_temuan'],
                                        'rekomendasi' => $x['rekomendasi'],
                                        'kode_rekomendasi' => $x['kode_rekomendasi'],
                                        'pengembalian' => $x['pengembalian'],
                                        'keterangan' => $x['keterangan'],

                                    ]);
                                }
                            }
                        }
                    }

                }
            }
        }

        $edittemuan = $request->edittemuan ?? array();
        $databaru   = [];

        // dd($request->temuan);


        // dd($edittemuan);
            // dump($ubahTipeA,$request->tipeA);
            foreach ($edittemuan as $ubahdata) {
                //LEVEL1
                foreach ($ubahdata['rekomendasi'] as $Temuanbaru) {
                    # code...
                    $TemuanbaruId = $Temuanbaru['id'] ?? null;
                    if ($TemuanbaruId) {
                        # code...
                        array_push($databaru,$TemuanbaruId);
                        JenisTemuan::where('id',$TemuanbaruId)->update([
                            'nama_temuan' => $ubahdata['nama_temuan'],
                            'kode_temuan' => $ubahdata['kode_temuan'],
                            'rekomendasi' => $Temuanbaru['rekomendasi'],
                            'kode_rekomendasi' => $Temuanbaru['kode_rekomendasi'],
                            'pengembalian' => $Temuanbaru['pengembalian'],
                            'keterangan' => $Temuanbaru['keterangan'],
                        ]);
                    }else {
                        # code...
                        JenisTemuan::create([
                            'id_pengawasans' => $id_pengawasans,
                            'nama_temuan' => $ubahdata['nama_temuan'],
                            'kode_temuan' => $ubahdata['kode_temuan'],
                            'rekomendasi' => $Temuanbaru['rekomendasi'],
                            'kode_rekomendasi' => $Temuanbaru['kode_rekomendasi'],
                            'pengembalian' => $Temuanbaru['pengembalian'],
                            'keterangan' => $Temuanbaru['keterangan'],

                        ]);
                    }

                    if (isset($Temuanbaru['sub'])) {
                        # code...
                        foreach ($Temuanbaru['sub'] as $TemuanSub) {
                            # code...
                            $TemuanSubId = $TemuanSub['id'] ?? null;
                            if ($TemuanSubId) {
                                # code...
                                array_push($databaru,$TemuanSubId);
                                JenisTemuan::where('id',$TemuanSubId)->update([
                                    'id_parent'   => $TemuanbaruId,
                                    'nama_temuan' => $ubahdata['nama_temuan'],
                                    'kode_temuan' => $ubahdata['kode_temuan'],
                                    'rekomendasi' => $TemuanSub['rekomendasi'],
                                    'kode_rekomendasi' => $TemuanSub['kode_rekomendasi'],
                                    'pengembalian' => $TemuanSub['pengembalian'],
                                    'keterangan' => $TemuanSub['keterangan'],
                                ]);
                            }else {
                                # code...
                                if ($TemuanSub['rekomendasi'] AND $TemuanSub['kode_rekomendasi'] AND $TemuanSub['keterangan']) {
                                    # code...
                                    $parent = JenisTemuan::create([
                                        'id_parent'   => $TemuanbaruId,
                                        'id_pengawasans' => $id_pengawasans,
                                        'nama_temuan' => $ubahdata['nama_temuan'],
                                        'kode_temuan' => $ubahdata['kode_temuan'],
                                        'rekomendasi' => $TemuanSub['rekomendasi'],
                                        'kode_rekomendasi' => $TemuanSub['kode_rekomendasi'],
                                        'pengembalian' => $TemuanSub['pengembalian'],
                                        'keterangan' => $TemuanSub['keterangan'],

                                    ]);

                                }
                            }

                            if (isset($TemuanSub['sub'])) {
                                # code...
                                foreach ($TemuanSub['sub'] as $TemuanSubBaru) {
                                    # code...
                                    $id = $TemuanSubBaru['id'] ?? null;
                                    if ($id) {
                                        # code...
                                        array_push($databaru,$id);
                                        JenisTemuan::where('id',$id)->update([
                                            'id_parent'   => $TemuanSubId,
                                            'nama_temuan' => $ubahdata['nama_temuan'],
                                            'kode_temuan' => $ubahdata['kode_temuan'],
                                            'rekomendasi' => $TemuanSubBaru['rekomendasi'],
                                            'kode_rekomendasi' => $TemuanSubBaru['kode_rekomendasi'],
                                            'pengembalian' => $TemuanSubBaru['pengembalian'],
                                            'keterangan' => $TemuanSubBaru['keterangan'],
                                        ]);
                                    }else {
                                        # code...
                                        if ($TemuanSubBaru['rekomendasi'] AND $TemuanSubBaru['kode_rekomendasi'] AND $TemuanSubBaru['keterangan']) {
                                            # code...
                                            $parent = JenisTemuan::create([
                                                'id_parent'   => $TemuanSubId,
                                                'id_pengawasans' => $id_pengawasans,
                                                'nama_temuan' => $ubahdata['nama_temuan'],
                                                'kode_temuan' => $ubahdata['kode_temuan'],
                                                'rekomendasi' => $TemuanSubBaru['rekomendasi'],
                                                'kode_rekomendasi' => $TemuanSubBaru['kode_rekomendasi'],
                                                'pengembalian' => $TemuanSubBaru['pengembalian'],
                                                'keterangan' => $TemuanSubBaru['keterangan'],

                                            ]);

                                        }
                                    }
                                }
                            }
                        }
                    }

                }
        }
        $datahapus = array_diff($datalama,$databaru);
        // dd($datalama,$databaru,$datahapus);
        JenisTemuan::destroy($datahapus);
        // dump('hapus',JenisTemuan::whereNull('id_pengawasans')->pluck('id')->toArray());
        DB::commit();
    }

        catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            dd($th->getMessage(),$th->getLine());
        }

        $surat->status_LHP = "Sedang Proses";
        $surat->save();





                return redirect('simptl/tipeB')->with('success','Data berhasil di simpan');

    }
    public function tipeBshow(Request $request,$id)
    {
        $surat = Pengawasan::find($id);
        $jt = JenisTemuan::where('id_pengawasans',$id)->whereNull('id_parent')->get()->groupBy('kode_temuan');
        return view('simptl.tipeB_detai',compact('surat','jt'));

    }
    // public function tipeBHapus()
    // {
    //     return view('simptl.tipeB_create');
    // }

    public function pkptCari(Request $request)
    {
        $filterid_obrik = '';
        $filterid_jenis_pengawasan = '';
        $filterbulan = '';
        $filtertahun = '';
        $filterid_irban = '';

        if ($request->obrik AND $request->jenisPengawasan AND $request->bulan) {
            $obrik = $request->Obrik;
            $jenisPengawasan = $request->jenisPengawasan;
            $filterbulan = $request->bulan;
            $penugasan = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik', 'jenis_pengawasans.id as id_jenis_pengawasan','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->join('jenis_pengawasans', 'jenis_pengawasans.id', '=', 'penugasans.id_jenis_pengawasan')->where('obriks.nama','like','%'.$request->obrik.'%')->where('jenis_pengawasans.nama','like','%'.$request->jenisPengawasan.'%')->whereMonth('penugasans.TanggalSurat','=',$request->bulan)->whereYear('TanggalSurat',session('tahun'))->get();
        }
        elseif ($request->obrik AND $request->jenisPengawasan) {
            $obrik = $request->Obrik;
            $jenisPengawasan = $request->jenisPengawasan;
            $penugasan = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik', 'jenis_pengawasans.id as id_jenis_pengawasan','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->join('jenis_pengawasans', 'jenis_pengawasans.id', '=', 'penugasans.id_jenis_pengawasan')->where('obriks.nama','like','%'.$request->obrik.'%')->where('jenis_pengawasans.nama','like','%'.$request->jenisPengawasan.'%')->whereYear('TanggalSurat',session('tahun'))->get();
        }
        elseif ($request->obrik AND $request->bulan) {
            $obrik = $request->Obrik;
            $filterbulan = $request->bulan;
            $penugasan = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->where('obriks.nama','like','%'.$request->obrik.'%')->whereMonth('penugasans.TanggalSurat','=',$request->bulan)->whereYear('TanggalSurat',session('tahun'))->get();
        }elseif ($request->obrik) {
            $obrik = $request->Obrik;
            $penugasan = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->where('obriks.nama','like','%'.$request->obrik.'%')->get();

        }
        elseif ($request->bulan) {
            $filterbulan = $request->bulan;
            $penugasan = Penugasan::whereMonth('TanggalSurat','=',$request->bulan)->whereYear('TanggalSurat','=',session('tahun'))->get();
        }
        elseif ($request->jenisPengawasan) {
            $jenisPengawasan = $request->jenisPengawasan;
            $penugasan = Penugasan::select('penugasans.id as id', 'jenis_pengawasans.id as id_jenis_pengawasan','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_obrik' )->join('jenis_pengawasans', 'jenis_pengawasans.id', '=', 'penugasans.id_jenis_pengawasan')->where('jenis_pengawasans.nama','like','%'.$request->jenisPengawasan.'%')->get();
         }

         $filterbulan = $request->bulan;
        $filterid_obrik = $request->obrik;
        $filterid_jenis_pengawasan = $request->jenisPengawasan;


        return view('simptl.includes.modals.pkpt',compact('penugasan','filterbulan','filterid_obrik','filterid_jenis_pengawasan'));
    }

    public function datadukung()
{
    $Pengawasan     = Pengawasan::where('created_at','like','%'.session('tahun').'%')->get();
    $jt = JenisTemuan::all();
    return view('simptl.datadukung',compact('Pengawasan','jt'));
}

public function datadukungShow(Request $request, $id)
{
    $surat = Pengawasan::find($id);
    $jt = JenisTemuan::where('id_pengawasans',$id)->get();
    return view('simptl.datadukung_detail',compact('surat','jt'));
}

public function UploadDatadukung(Request $request,$id)
{
    $surat = Pengawasan::find($id);
    $surat->status_LHP = "LHP Jadi";
    $surat->save();
    $id_pengawasans = $surat->id;
    if ($request->has('file')) {
        # code...
        foreach ($request->file('file') as $name) {
            # code...
             $filename = $name->getClientOriginalName();
             $name->move(public_path('dokumen'),$filename);
             File::create([
                'id_pengawasan' => $id_pengawasans,
                'file'=>$filename
             ]);
        }
    }

}

public function tipeC()
{
    $surat = Pengawasan::find($id);
    $id_pengawasans = $surat->id;

    $id_pengawasans   =$id_pengawasans;
    $kode_temuan      =$request->kode_temuan;
    $nama_temuan      =$request->nama_temuan;
    $rekomendasi      =$request->rekomendasi;
    $keterangan       =$request->keterangan;
    $kode_rekomendasi =$request->kode_rekomendasi;
    $pengembalian     =$request->pengembalian;



            for ($y=0; $y < count($kode_temuan) ; $y++) {
                # code...
                for ($i=0; $i < count($kode_rekomendasi) ; $i++) {
                    # code...
                    $datasave = [
                        'id_pengawasans' => $id_pengawasans,
                        'rekomendasi' => $rekomendasi[$i],
                        'keterangan' => $keterangan[$i],
                        'kode_rekomendasi' => $kode_rekomendasi[$i],
                        'pengembalian' => $pengembalian[$i],
                        'kode_temuan' => $kode_temuan[$y],
                        'nama_temuan' => $nama_temuan[$y]

                    ];

                    DB::table('jenis_temuans')->insert($datasave);
                    }
                }

            return redirect('tipeB')->with('success','Data berhasil di simpan');
}

public function searchJP(Request $request )
{

    if($request->ajax())
    {
    $output="";
    $penugasans = Penugasan::select('penugasans.id as id', 'obriks.id as id_obrik', 'jenis_pengawasans.id as id_jenis_pengawasan','penugasans.noSurat','penugasans.Tanggalsurat','penugasans.TanggalAkhir','penugasans.id_jenis_pengawasan','penugasans.tanggalterbitSurat' )->join('obriks', 'obriks.id', '=', 'penugasans.id_obrik')->join('jenis_pengawasans', 'jenis_pengawasans.id', '=', 'penugasans.id_jenis_pengawasan')
    ->when($request->obrik,function($query) use ($request){
        $query->where('obriks.nama','like','%'.$request->obrik.'%')->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();
    })
    ->when($request->jenisPengawasan,function($query) use ($request){
        $query->where('jenis_pengawasans.nama','like','%'.$request->jenisPengawasan.'%')->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();
    })
    ->when($request->bulan,function($query) use ($request){
        $query->whereMonth('penugasans.TanggalSurat','=',$request->bulan)->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();
    })
    ->when($request->tahun,function($query) use ($request){
        $query->whereYear('penugasans.TanggalSurat','=',$request->tahun)->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();
    })
    ->get();
    if($penugasans)
    {
    foreach ($penugasans as $key => $penugasan) {
    $url = url("simptl/pkpt_tambah/" . $penugasan->id);
    $output.='<tr>'.
    '<td> 094/'.$penugasan->noSurat.'/03/'.date("Y").'</td>'.
    '<td>'.$penugasan->obrik->nama.'</td>'.
    '<td>'.$penugasan->jenis->nama.'</td>'.
    '<td>'. Carbon::parse($penugasan->Tanggalsurat)->translatedFormat('F').'</td>'.
    '<td>'. Carbon::parse($penugasan->Tanggalsurat)->translatedFormat('Y').'</td>'.
    '<td>'.'<a href='.$url.
    ' class="btn btn-outline-primary ">Pilih </a>'.'</td>'.
    '</tr>';
    }
    return Response($output);
       }

    }

}

public function datadukungTipeA()
{
    $Pengawasan     = Pengawasan::where('tipe','=','Rekomendasi')->where('created_at','like','%'.session('tahun').'%')->get();
    $jt = JenisTemuan::all();
    return view('simptl.datadukungRekom',compact('Pengawasan','jt'));
}

public function datadukungTipeB()
{
    $Pengawasan     = Pengawasan::where('tipe','=','TemuandanRekomendasi')->where('created_at','like','%'.session('tahun').'%')->get();
    $jt = JenisTemuan::all();
    return view('simptl.datadukungTemuanRekom',compact('Pengawasan','jt'));
}

public function datadukungTipeAEdit($id)
{
    $surat = Pengawasan::find($id);
    $jt = JenisTemuan::where('id_pengawasans',$id)->whereNull('id_parent')->get();
    return view('simptl.datadukung_editRekom',compact('jt','surat'));
}

public function datadukungtipeAstore(Request $request,$id)
    {

       foreach ($request->file('files') as $key => $file) {
        # code...

        $filename = $key.time().'.'.$file->extension();

        $file->move(public_path('Berkas_Simptl'), $filename);
        JenisTemuan::where('id',$key)->update([
            'file' => $filename,
        ]);

       }
       $surat = Pengawasan::find($id);
       $surat->status_LHP = "LHP Jadi";
       $surat->save();

       return redirect('simptl/data_dukungRekom')->with('success','Data berhasil di simpan');
        }

        public function datadukungTipeBEdit($id)
        {
            $surat = Pengawasan::find($id);
            $jt = JenisTemuan::where('id_pengawasans',$id)->whereNull('id_parent')->get()->groupBy('kode_temuan');
            return view('simptl.datadukung_editTemuan',compact('jt','surat'));
        }

        public function datadukungtipeBstore(Request $request,$id)
            {
               foreach ($request->file('files') as $key => $file) {
                # code...
                $filename = $key.time().'.'.$file->extension();

                $file->move(public_path('Berkas_Simptl'), $filename);
                JenisTemuan::where('id',$key)->update([
                    'file' => $filename,
                ]);

               }

               $surat = Pengawasan::find($id);
               $surat->status_LHP = "LHP Jadi";
               $surat->save();

               return redirect('simptl/data_dukungTemuanRekom')->with('success','Data berhasil di simpan');

                }

    public function viewBerkas($filename)
    {
        return response()->file(public_path().'/Berkas_Simptl/'.$filename);
    }

    }







