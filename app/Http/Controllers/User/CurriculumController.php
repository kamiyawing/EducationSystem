<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use Carbon\Carbon;


class CurriculumController extends Controller
{

public function index(Request $request)
{
    $grades = config('grades.grades');
    $gradeId = $request->input('grade_id');
    $gradeColors = config('grades.gradeColors');
    $year = $request->input('year', now()->year);
    $month = $request->input('month', now()->month); // 初期値は今月
    $date = Carbon::createFromDate($year, $month, 1);
    $prev = $date->copy()->subMonth();
    $next = $date->copy()->addMonth();

    $curriculums = Curriculum::with('deliveryTimes')
       ->where(function ($query) use ($month, $year){
        //常時フラグオン時 
        $query->where('always_delivery_flg', true)


        //該当付き設定
        ->orWhereHas('deliveryTimes', function ($q) use ($month, $year) {
                $q->whereYear('delivery_from', $year)
                  ->whereMonth('delivery_from', $month);
            });
        }) 
        ->when($gradeId, function ($query, $gradeId) {
            return $query->where('grade_id', $gradeId);
        })
        ->get();

    return view('user/curriculum_list', compact('curriculums', 'month', 'year', 'date', 'prev', 'next', 'grades', 'gradeColors', 'gradeId'));
}

public function deliveryTimes()
{
    return $this->hasMany(DeliveryTime::class, 'curriculums_id');
}

}