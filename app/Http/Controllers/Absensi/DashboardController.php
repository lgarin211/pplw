<?php

namespace App\Http\Controllers\Absensi;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $hariini  = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $pegawai = Pegawai::where("user_id", session("id"))->first();
        $presensiHariini = DB::table('absensis')->where('tgl_presensi',$hariini)->where("id_pegawai",$pegawai->id)->first();
        $historiPresensi = DB::table('absensis')->where("id_pegawai",$pegawai->id)->whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')->whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')->orderBy('tgl_presensi')->get();

        $rekapPresensi = DB::table('absensis')->selectRaw('COUNT(id_pegawai) as jmlhadir, SUM(IF(jam_in > "07:30",1,0)) as jmlterlambat ')->where("id_pegawai",$pegawai->id)->whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')->whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')->first();

        $leaderboard = DB::table('absensis')->join('pegawais','absensis.id_pegawai', '=', 'pegawais.id')->where("tgl_presensi",$hariini)->orderBy('jam_in')->get();

        $namaBulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        return view('absensi.dashboard',compact('pegawai','presensiHariini','historiPresensi','namaBulan','bulanini','tahunini','rekapPresensi','leaderboard'));
    }
    public function LoginAbsen(Request $request)
    {
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
                $request->session()->put("name", $cekuser->name);
                $request->session()->put("username", $cekuser->username);
                $request->session()->put("tahun", date('Y'));
                $request->session()->put("level", $cekuser->level);
                // dd($cekuser);

                if ($cekuser->level == 'THL') {
                    return redirect('absensi_thl');
                }
            } else {
                return redirect('/');
            }


        }
    }
}
