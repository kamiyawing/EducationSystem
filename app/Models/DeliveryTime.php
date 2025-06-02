<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculums_id',
        'delivery_from',
        'delivery_to',
    ];

    // 正しいリレーション
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id');
    }

    public static function saveTimesForCurriculum($curriculumId, array $times)
    {
        $submittedIds = [];

        foreach ($times as $time) {
            $data = [
                'curriculums_id' => $curriculumId,
                'delivery_from' => Carbon::parse($time['from_date'] . ' ' . $time['from_time']),
                'delivery_to'   => Carbon::parse($time['to_date'] . ' ' . $time['to_time']),
            ];

            if (!empty($time['id'])) {
                $existing = self::find($time['id']);
                if ($existing) {
                    $existing->update($data);
                    $submittedIds[] = $existing->id;
                }
            } else {
                $new = self::create($data);
                $submittedIds[] = $new->id;
            }
        }

        self::where('curriculums_id', $curriculumId)
            ->whereNotIn('id', $submittedIds)
            ->delete();
    }
}