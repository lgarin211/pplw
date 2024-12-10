<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

     public function pangkat()
    {
        return $this->hasOne(Pangkat::class, 'id', 'id_pangkat');
    }
    public function transportasi()
    {
        return $this->hasOne(Transportasi::class,'id','id_kendaraan');
    }
    public function Jabatan()
    {
        return $this->hasOne(Jabatan::class, 'id', 'id_jabatan');
    }
    public function eselon()
    {
        return $this->hasOne(Eselon::class, 'id', 'id_eselon');
    }
    public function anggaran()
    {
        return $this->hasOne(kegiatan::class, 'id', 'id_anggaran');
    }
    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
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
            return strtoupper($this->nama_karyawan);
        }
        return $hasil23;
    }


}
