<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;  // ★ 追加
use App\Models\Grade;       // ★ 追加

class CurriculumController extends Controller
{
    public function index()
    {
            // 授業一覧を取得
        $curriculums = Curriculum::all();
        
        // 学年一覧を取得（Gradeモデルが存在する場合）
        $grades = Grade::all();

        // もし、選択中の学年があればそれをセット（なければnullでも可）
        $selectedGrade = null; // 例: 初期状態で未選択の場合

        return view('user.curriculum_list', compact('curriculums', 'grades', 'selectedGrade'));
         // 時間割画面のビューを返す
    }
    public function filterByGrade(Request $request, $gradeId)
    {
        // 選択された学年に絞った授業一覧を取得
        $curriculums = Curriculum::where('grade_id', $gradeId)->get();
        
        // 全学年情報を取得
        $grades = Grade::all();
        $selectedGrade = Grade::findOrFail($gradeId);
        
        return view('user.curriculum_list', compact('curriculums', 'grades', 'selectedGrade'));
    }
}
