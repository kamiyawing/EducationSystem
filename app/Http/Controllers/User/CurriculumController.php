<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;


class CurriculumController extends Controller
{

public function index(Request $request)
{
    $grade = $request->input('grade_id');
    $month = $request->input('month', now()->month); // 初期値は今月
    $year = $request->input('year', now()->year);

    $curriculums = Curriculum::with('deliveryTimes')
       ->where(function ($query) use ($month, $year){
        //常時フラグオン時 
        $query->where('always_delivery_flg', 1)


        //該当付き設定
        ->orWhereHas('deliveryTimes', function ($q) use ($month, $year) {
                $q->whereYear('delivery_from', $year)
                  ->whereMonth('delivery_from', $month);
            });
        }) 
        ->when($grade, function ($query) use ($grade) {
            $query->where('grade_id', $grade);
        })
        ->get();


                        $grades = [
                            1 => '小学生1年生',
                            2 => '小学生2年生',
                            3 => '小学生3年生',
                            4 => '小学生4年生',
                            5 => '小学生5年生',
                            6 => '小学生6年生',
                            7 => '中学生1年生',
                            8 => '中学生2年生',
                            9 => '中学生3年生',
                            10 => '高校生1年生',
                            11 => '高校生2年生',
                            12 => '高校生3年生',
                            ];

    return view('user/curriculum_list', compact('curriculums', 'grade', 'month'));
}

public function deliveryTimes()
{
    return $this->hasMany(DeliveryTime::class, 'curriculums_id');
}
}