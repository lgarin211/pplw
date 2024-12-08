<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penugasan',
        'nama',
        'tipe',
        'jenis',
        'wilayah',
        'pemeriksa',
        'id_user',
        'status_LHP'
    ];
    public function surat()
    {
        return $this->hasOne(Penugasan::class, 'id', 'id_penugasan');
    }


}
