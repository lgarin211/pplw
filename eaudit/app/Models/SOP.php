<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOP extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = array('id_pegawai','created_at','updated_at');

    public function sopDetail()
    {
        return $this->hasMany(SOPDetail::class,'id_sop','id');
    }
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }
}
