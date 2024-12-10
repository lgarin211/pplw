<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    use HasFactory;

    public function getPangkatBaruAttribute()
    {
        $hasil = '';
        if (($posisi = strpos($this->nama,'/')) !== false) {
            # code...
            $hasil = substr($this->nama,0,$posisi);
        }
        return $hasil;
    }

    public function getGolonganAttribute()
    {
        $hasil = '';
        if (($posisi = strpos($this->nama,'/')) !== false) {
            # code...
            $hasil = substr($this->nama,$posisi+1);
        }
        return $hasil;
    }
}
