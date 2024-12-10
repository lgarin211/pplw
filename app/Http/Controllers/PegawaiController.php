<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eselon;
use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    //
    public function index(Request $request)
    {

        $pegawai = '';
        if ($request->has('search')) {
            $data = Pegawai::where('nama_karyawan','like','%'.$request->search.'%')->orderBy('nama_karyawan', 'ASC')->paginate(10);
        }else {
            # code...
            $data = Pegawai::orderBy('nama_karyawan', 'ASC')->paginate(10);
        }
        $pegawai = $request->search;
        return view('admin.pegawai',compact('data','pegawai'));
    }
    public function create()
    {
        $ps = Pangkat::all();
        $j  = Jabatan::all();
        $e  = Eselon::all();
        return view('admin.pegawai_create',compact('ps','j','e'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $input['nip'] = $request->nip;
        $input['id_pangkat'] = $request->id_pangkat;
        $input['id_jabatan'] = $request->id_jabatan;
        $input['id_eselon'] = $request->id_eselon;
        $input['nama_karyawan'] = $request->nama_karyawan;
        $input['rekening'] = $request->rekening;
        $input['status'] = $request->status;
        Pegawai::insert($input);



        return redirect('pegawai')->with('success','Data berhasil di simpan');

    }
    public function edit($id)
    {
        $ps       = Pangkat::all();
        $j       = Jabatan::all();
        $e       = Eselon::all();
        $pegawai = pegawai::where('id',$id)->first();
        return view('admin.pegawai_edit',compact('pegawai','ps','j','e'));
    }
    public function update(Request $request, $id)
    {
        $pegawai = pegawai::find($id);
        $pegawai->nama_karyawan = $request->input('nama_karyawan');
        $pegawai->nip = $request->input('nip');
        $pegawai->id_pangkat = $request->input('id_pangkat');
        $pegawai->id_jabatan = $request->input('id_jabatan');
        $pegawai->id_eselon = $request->input('id_eselon');
        $pegawai->rekening = $request->input('rekening');
        $pegawai->status = $request->input('status');
        $pegawai->save();

        return redirect('pegawai')->with('info','Data berhasil di Edit');
    }
    public function hapus($id)
    {
        $pegawai = pegawai::where('id',$id)->first();
        $pegawai->delete();

        return redirect('pegawai')->with('warning','Data berhasil di Hapus');
    }
    public function show($id)
    {
        $pegawai = pegawai::where('id',$id)->first();
        return view("admin.pegawai_detail", compact('pegawai'));
    }

    public function storeKaryawan(Request $request)
    {
        $masuk["name"] = $request->nama_karyawan;
        $masuk["email"] = $request->email_karyawan;
        $masuk["level"] = $request->level_karyawan;
        $masuk["password"] = bcrypt($request->password);
        $masuk["divisi_id"] = $request->divisi_id;
        $masuk["departmen_id"] = $request->departmen_id;
        $masuk["cabang_id"] = $request->cabang_id;
        $user = User::create($masuk);
        $user->save();


        $input['user_id'] = $user->id;
        $input['id_jabatan'] = $request->id_jabatan;
        $input['id_pangkat'] = $request->id_pangkat;
        $input['id_grade'] = $request->id_grade;
        $input['id_shift'] = $request->id_shift;
        $input['nama_karyawan'] = $request->nama_karyawan;
        $input['nik_karyawan'] = $request->nik_karyawan;
        $input['email_karyawan'] = $request->email_karyawan;

        $input['hp_karyawan'] = $request->hp_karyawan;
        $input['wa_karyawan'] = $request->wa_karyawan;
        $input['masuk_karyawan'] = $request->masuk_karyawan;
        $input['selesai_kontrak_karyawan'] = $request->selesai_kontrak_karyawan;
        $input['darah_karyawan'] = $request->darah_karyawan;
        $input['tanggal_lahir_karyawan'] = $request->tanggal_lahir_karyawan;
        $input['tempat_lahir_karyawan'] = $request->tempat_lahir_karyawan;
        $input['alamat_ktp_karyawan'] = $request->alamat_ktp_karyawan;
        $input['alamat_domisili_karyawan'] = $request->alamat_domisili_karyawan;
        $input['jk_karyawan'] = $request->jk_karyawan;
        $input['status_pernikahan_karyawan'] = $request->status_pernikahan_karyawan;
        $input['pendidikan_karyawan'] = $request->pendidikan_karyawan;
        $input['rekening_karyawan'] = $request->rekening_karyawan;
        $input['bpjs_kesehatan_karyawan'] = $request->bpjs_kesehatan_karyawan;
        $input['bpjs_ketenagakerjaan_karyawan'] = $request->bpjs_ketenagakerjaan_karyawan;
        $input['ukuran_baju_karyawan'] = $request->ukuran_baju_karyawan;
        Karyawan::insert($input);

        return redirect('admin/data_karyawan');
    }
}
