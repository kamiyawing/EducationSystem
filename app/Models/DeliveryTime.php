<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    public function curriclum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}   
