<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLain extends Model
{
    use HasFactory;
     public function Pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }

    public function getPerhitunganDinasLuarAttribute()
    {

        $sekarang = strtotime($this->tanggalawal);
        $akhir = strtotime($this->tanggalakhir);

        // Loop between timestamps, 24 hours at a time

        $sampai = $akhir; // or your date as well
        $dari = $sekarang;
        $datediff = $sampai - $dari;

        if (empty($sampai)) {
          $jumlahHari = 0;
        } else {
          $jumlahHari =  round($datediff / (60 * 60 * 24))+1;
        }

        return $jumlahHari;
    }

    protected $fillable =["id_pegawai","tanggalawal","tanggalakhir","keterangan"];
}
