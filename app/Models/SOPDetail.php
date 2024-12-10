<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SOPDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = array('id_sop','sop','created_at','updated_at');

    public function sop()
    {
        return $this->hasOne(SOP::class, 'id', 'id_sop');
    }
}
