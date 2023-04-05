<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function childrenAsMother()
    {
        return $this->hasMany(Children::class, 'mother_id');
    }

    public function childrenAsFather()
    {
        return $this->hasMany(Children::class, 'father_id');
    }

    public function childrenAsGuardian()
    {
        return $this->hasMany(Children::class, 'guardian_id');
    }

    
}
