<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLHP extends Model
{
    use HasFactory;
     protected $fillable = array('nama','created_at','updated_at');


      public function surat()
    {
        return $this->hasMany(LHP::class,'id_lhp','id');
    }
}
