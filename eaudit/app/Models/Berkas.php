<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;
     public function pegawai()
    {
        return $this->hasOne(pegawai::class,'id', 'id_karyawan');
    }
    public function peran()
    {
        return $this->hasOne(peran::class,'id', 'id_peran');
    }
    // public function anggaran()
    // {
    //     return $this->hasOne(Kegiatan::class,'id','id_anggaran');
    // }
}
