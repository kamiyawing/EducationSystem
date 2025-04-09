<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    // use HasFactory;

    // protected $table = 'grades';

    public function curriclums()
    {
        return $this->hasMany(Curriculum::class);
    }
}
