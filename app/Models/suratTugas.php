<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JadwalLain;
use App\Models\JadwalLibur;

class suratTugas extends Model
{
    use HasFactory;

      public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_karyawan');
    }

      public function surat()
    {
        return $this->hasOne(Penugasan::class, 'id', 'id_penugasan');
    }

      public function peran()
    {
        return $this->hasOne(Peran::class, 'id', 'id_peran');
    }

    protected $fillable = [
        'id_karyawan', 'id_peran', 'id_penugasan','ta','tp'
    ];

    public function getPerhitunganHariAttribute(){
        #menghitung tarif per karyawannya.
        $sekarang = strtotime($this->ta);
        $akhir = strtotime($this->tp);
        $idpegawai = $this->id_karyawan;
        // $tanggalawal = Jadwallain::where(strtotime('tanggalawal'));
        // $tanggalakhir = Jadwallain::where(strtotime('tanggalakhir'));
        $pengurangan = 0;
            // Loop between timestamps, 24 hours at a time
            for ( $i = $sekarang; $i <= $akhir; $i = $i + 86400 ) {
              if (date("D",$i)=='Sat' OR date("D",$i) == "Sun" ) {
                  $pengurangan += 1;
                  continue;
              }
              //mengambil data jadwal lain
              $tanggali = date("Y-m-d",$i);
              $jadwal = Jadwallain::where('id_pegawai','=',$idpegawai)->where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
              if ($jadwal > 0 ) {
                # code...
                $pengurangan += 1;
                continue;
              }
              $jadwalLibur = JadwalLibur::where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
              if ($jadwalLibur > 0) {
                # code...
                $pengurangan += 1;
                continue;
              }

              $hariTengah = suratTugas::where('id_karyawan',$idpegawai)->whereRaw("'$tanggali' BETWEEN ta AND tp")->orderBy('id')->get();

              # mengambil data pegawai yang tanggalnya ada diantara ta dan tp

              if ($hariTengah->count() > 1) {
                if ($hariTengah->last()->id != $this->id) {
                    $pengurangan += 1;
                    continue;
                }
              }
            }
            $total = 0;
            $idsurat= $this->id;
            $sekarang = strtotime($this->ta);
            $akhir = strtotime($this->tp);

            if (isset($pengurangan)) {
                $totalpengurangan = $pengurangan;
            } else {
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



            return $jumlahHari;

    }

    public function getPerhitunganAttribute(){
        $jumlahHari = $this->PerhitunganHari;
        $total = ($jumlahHari  *  $this->peran->tarif);
        return $total;
    }

    public function getPerhitunganHariTunggalAttribute(){
        #menghitung tarif per karyawannya.

        $sekarang = strtotime($this->ta);
        $akhir = strtotime($this->tp);
        $idpegawai = $this->id_karyawan;
        $pengurangan = 0;
            // Loop between timestamps, 24 hours at a time
            for ( $i = $sekarang; $i <= $akhir; $i = $i + 86400 ) {
              if (date("D",$i)=='Sat' OR date("D",$i) == "Sun" ) {
                  $pengurangan += 1;
                  continue;
              }
              //mengambil data jadwal lain
              $tanggali = date("Y-m-d",$i);
              $jadwalLibur = JadwalLibur::where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
              if ($jadwalLibur > 0) {
                # code...
                $pengurangan += 1;
                continue;
              }

              $hariTengah = suratTugas::where('id_karyawan',$idpegawai)->whereRaw("'$tanggali' BETWEEN ta AND tp")->orderBy('id')->get();
              # mengambil data pegawai yang tanggalnya ada diantara ta dan tp
              if ($hariTengah->count() > 1) {
                # code...
                ##fist / last

                if ($hariTengah->last()->id != $this->id) {
                    #mengambil data yang lama di cek = id yang sekarang
                    # code...
                    $pengurangan += 1;
                    continue;
                }
              }
              //mengambil data jadwal libur
            }
            $total = 0;

            $idsurat= $this->id;
            $sekarang = strtotime($this->ta);
            $akhir = strtotime($this->tp);

            if (isset($pengurangan)) {
                # code...
                $totalpengurangan = $pengurangan;
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



            return $jumlahHari;

    }





}
