<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;
    protected $table = 'curriculums';
    protected $fillable = ['title', 'video_url', 'description', 'grade_id', 'alway_delivery_flg' , 'thumbnail'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function delivery_times()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }

    public static function createFromRequest($request)
    {


    $curriculum = new self();
    $curriculum->title = $request->input('title');
    $curriculum->video_url = $request->input('video_url');
    $curriculum->description = $request->input('description');
    $curriculum->grade_id = $request->input('grade_id');
    $curriculum->alway_delivery_flg = $request->input('alway_delivery_flg') ? 1 : 0;

        if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');

        if ($file->isValid()) {
            $originalName = $file->getClientOriginalName();
            $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $originalName);
            $file->storeAs('thumbnails', $safeName, 'public');
            $curriculum->thumbnail = $safeName;
        }
    }

    $curriculum->save();

        if (!$request->has('alway_delivery_flg')) {
            $times = $request->input('delivery_times');
            foreach ($times as $time) {
                DeliveryTime::create([
                    'curriculums_id' => $curriculum->id,
                    'delivery_from' => $time['from_date'] . ' ' . $time['from_time'],
                    'delivery_to' => $time['to_date'] . ' ' . $time['to_time'],
                ]);
            }
        }

    return $curriculum;
    }

    public function updateFromRequest($request)
    {
    $this->fill($request->only(['title', 'video_url', 'description', 'grade_id']));
    $this->alway_delivery_flg = $request->input('alway_delivery_flg') == '1' ? 1 : 0;

    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');

        if ($file->isValid()) {
            $originalName = $file->getClientOriginalName();
            $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $originalName);
            $file->storeAs('thumbnails', $safeName, 'public');
            $this->thumbnail = $safeName;
        }
    }

    $this->save();
    }

}
