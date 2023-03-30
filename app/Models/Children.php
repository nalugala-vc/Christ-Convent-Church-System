<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mother(){
        return $this->belongsTo(Members::class,'mother_id');
    }

    public function father(){
        return $this->belongsTo(Members::class,'father_id');
    }

    public function guardian(){
        return $this->belongsTo(Members::class,'guardian_id');
    }
}
