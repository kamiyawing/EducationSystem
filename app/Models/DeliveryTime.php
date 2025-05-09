<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    protected $table = 'delivery_times';

    protected $fillable = [
        'curriculum_id',
        'delivery_from',
        'delivery_to',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }
}
