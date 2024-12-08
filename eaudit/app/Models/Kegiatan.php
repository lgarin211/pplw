<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
       public function pengguna()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pengguna');
    }
    public function pptk()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pptk');
    }
}
