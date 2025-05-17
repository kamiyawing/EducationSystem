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
    public function userProgress() {
        $userId = Auth::id();
        $userData = User::where('id', $userId)->with('grade','curriculum_progress')->firstOrFail();
        $gradesWithCurriculums = Grade::with('curriculums')->get();
        $userProgressStatus = $userData->curriculum_progress->keyBy('id')->map(function ($curriculum) {
        return $curriculum->progress->clear_flg;
        });
        return view('auth/curriculum_progress', compact('userData', 'gradesWithCurriculums', 'userProgressStatus'));
    }

    public function deliveryVideo($id){
        $curriculumData = Curriculum::where('id', $id)->first();
        return view('auth/delivery', compact('curriculumData'));
    }
}
