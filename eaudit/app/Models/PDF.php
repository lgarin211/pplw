<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDF extends Model
{
    use HasFactory;

       protected $primaryKey = 'id';
    protected $fillable = array('id_tte','pdf','created_at','updated_at');

        public function surat()
    {
        return $this->hasOne(TTE::class, 'id', 'id_tte');
    }
}
