<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;
    protected $table = 'curriculums';
    protected $fillable = ['title', 'video_url', 'description', 'grade_id', 'alway_delivery_flg'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function delivery_times()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

}
