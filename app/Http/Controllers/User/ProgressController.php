<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index() {
        $userId = Auth::id();
        $userData = User::where('id', $userId)->with('grade','curriculum_progress')->firstOrFail();
        $gradesWithCurriculums = Grade::with('curriculums')->get();
        $userProgressStatus = $userData->curriculum_progress->keyBy('id')->map(function ($curriculum) {
        return optional($curriculum->progress)->clear_flg; // nullの場合はエラーを防ぐ！
        });        
        return view('auth/curriculum_progress', compact('userData', 'gradesWithCurriculums', 'userProgressStatus'));
    }

    public function deliveryVideo($id){
        $curriculumData = Curriculum::findOrFail($id);
        return view('auth/delivery', compact('curriculumData'));
    }
}