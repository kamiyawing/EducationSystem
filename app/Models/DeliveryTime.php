<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{

    protected $fillable = [
        'curriculums_id',    // ← このカラム名を追加！
        'delivery_from',
        'delivery_to',
    ];

    use HasFactory;

    public function curriclum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}   
