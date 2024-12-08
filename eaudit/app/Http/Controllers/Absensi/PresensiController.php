<?php

namespace App\Http\Controllers\Absensi;

use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    //
    public function create()
    {
        $hariini  = date("Y-m-d");
        $user     = User::find(session("id"));
        $karyawan = Pegawai::where("user_id", $user->id)->first();
        $cek      = DB::table('absensis')->where('tgl_presensi',$hariini)->where("id_pegawai",$karyawan->id)->count();
        return view('absensi.tombol.create',compact('cek'));
    }

    public function store(Request $request)
    {
        $pegawai = Pegawai::where("user_id", session("id"))->first();
        $idPegawai    = $pegawai->id;
        $tgl_presensi = date("Y-m-d");
        $jam          = date("H:i:s");
        $latitudekantor  = -7.433522041549346;
        $longitudekantor =  111.0220353011107;
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",",$lokasi);
        $latitudeuser  = $lokasiuser[0];
        $longitudeuser =  $lokasiuser[1];



        $jarak = $this->distance($latitudekantor, $longitudekantor, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);


        $image  = $request->image;

        $folderPath = "public/uploads/absensi/";
        $formatname = $idPegawai."-".$tgl_presensi;
        $imagepart  = explode(";base64",$image);
        $image_base64 = base64_decode($imagepart[1]);
        $fileName = $formatname.".png";

        $file = $folderPath.$fileName;
        $data = [
            'id_pegawai'   => $idPegawai,
            'tgl_presensi' => $tgl_presensi,
            'jam_in'       => $jam,
            'foto_in'      => $fileName,
            'location_in'  => $lokasi
        ];
        $cek     = DB::table('absensis')->where('tgl_presensi',$tgl_presensi)->where("id_pegawai",$pegawai->id)->count();
        if ($radius > 51) {
            echo "error|Maaf Anda Berada Diluar Radius, Jarak Anda|".$radius."Meter dari Kantor";
        } else {
            if ($cek > 0) {
                # code...
                $dataPulang = [
                    'jam_out'       => $jam,
                    'foto_out'      => $fileName,
                    'location_out'  => $lokasi
                ];
                $update = DB::table('absensis')->where('tgl_presensi',$tgl_presensi)->where("id_pegawai",$pegawai->id)->update($dataPulang);
                if ($update) {
                    # code...
                    echo "success|Terimakasih, Hati Hati di Jalan|out";
                    Storage::put($file, $image_base64);
                }else {
                    echo "error|Maaf Anda Gagal Absen, Silahkan Hubungi Pihak IT|out";
                }
            }else {
                # code...
                $simpan = DB::table('absensis')->insert($data);
                if ($simpan) {
                    # code...
                    echo "success|Terimakasih, Selamat Bekerja|in";
                    Storage::put($file, $image_base64);
                }else {
                    echo 1;
                }
            }
        }



    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
}
