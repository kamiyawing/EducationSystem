<?php

namespace App\Http\Controllers\User;

class CurriculumContoroller extends Controller
{

public function index(Request $request)
{
    $grade = $request->input('grade_id');
    $month = $request->input('month', now()->month); // 初期値は今月

    $curriculums = Curriculum::when($grade, function($query) use ($grade) {
                            return $query->where('grade_id', $grade);
                        })
                        ->get();

    return view('user/curriculum_list', compact('curriculums', 'grade', 'month'));
}
}