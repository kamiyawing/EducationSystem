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

    $curriculums = Curriculum::when($grade, function($query) use ($grade) {
                            return $query->where('grade_id', $grade);
                        })
                        ->get();

    return view('user/curriculum_list', compact('curriculums', 'grade', 'month'));
}
}