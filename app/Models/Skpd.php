<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    use HasFactory;
    public function Pemimpin()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }
    public function bendahara()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_bendahara');
    }

    public function getNamaBaruAttribute()
    {
        $hasil23 = '';
        $hasil11 = '';
        $gelar = '';
        $posisi2 = '';
        if (($posisi1 = strpos($this->nama_karyawan,'.')) !== false) {
            # code...
            if ($posisi1 < 5) {
                # code...
                $hasil21 = substr($this->nama_karyawan,0,$posisi1);
                $hasil23 = ucwords($hasil21);
            }
            if (($posisi2 = strpos($this->nama_karyawan,',')) !== false) {
                $hasil12 = substr($this->nama_karyawan,strlen($hasil23),$posisi2-strlen($hasil23));
                $hasil11 = strtoupper($hasil12);
            }
            $hasil23 .= $hasil11;
            $gelar = substr($this->nama_karyawan, $posisi2);
            $hasil23 .= $gelar;
        }

        if ($hasil23 == '') {
            # code...
            return $this->nama_karyawan;
        }
        return $hasil23;
    }
}
