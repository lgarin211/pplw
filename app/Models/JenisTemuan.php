<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTemuan extends Model
{
    use HasFactory;

    protected $fillable = ['id_pengawasans','id_parent', 'nama_temuan', 'kode_temuan','rekomendasi', 'pengembalian', 'keterangan','kode_rekomendasi'];


    public function pengawasan()
    {
        return $this->hasOne(Pengawasan::class, 'id', 'id_pengawasans');
    }

    public function sub()
    {
        return $this->hasMany(JenisTemuan::class, 'id_parent', 'id');
    }
}
