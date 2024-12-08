<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LHP extends Model
{
    use HasFactory;

        protected $fillable = array('id_lhp','lhp','created_at','updated_at');

        public function surat()
    {
        return $this->hasOne(MasterLHP::class, 'id', 'id_lhp');
    }
}
