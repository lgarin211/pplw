<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TTE extends Model
{
    use HasFactory;
     protected $primaryKey = 'id';
    protected $fillable = array('nama','created_at','updated_at');


      public function surat()
    {
        return $this->hasMany(PDF::class,'id_tte','id');
    }
}
