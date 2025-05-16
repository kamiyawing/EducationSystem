<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use App\Http\Requests\CurriculumRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCurriculumCreate()
    {   
        $grades = Grade::all();
        return view('admin.layouts.curriculum_create' , [
            'grades' => $grades
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exeCurriculumStore(CurriculumRequest $request)
    {

        \DB::beginTransaction();
        try {
            $curriculum = new Curriculum();

            $curriculum->title = $request->input('title');
            $curriculum->video_url = $request->input('video_url');
            $curriculum->description = $request->input('description');
            $curriculum->grade_id = $request->input('grade_id');
            $curriculum->alway_delivery_flg = $request->input('alway_delivery_flg') ? 1 : 0;

            $curriculum->save();
            \DB::commit();

        } catch(\Throwable $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
            abort(500);
        }

        \Session::flash('err_msg','授業を登録しました');
        return redirect(route('admin.show.curriculum.list'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function showCurriculumList()
    {
        $grades = Grade::all();
        $selectedGrade = Grade::find(1);
        $curriculums = Curriculum::where('grade_id', 1)->with('delivery_times')->paginate(6);

        return view('admin.layouts.curriculum_list', compact('grades', 'curriculums', 'selectedGrade'));
        
    }


    public function showCurriculumByGrade($grade_id)
    {   

        $grades = Grade::all();
        $curriculums = Curriculum::where('grade_id', $grade_id)->with('delivery_times')->paginate(6);
        $selectedGrade = Grade::find($grade_id);

        return view('admin.layouts.curriculum_list', compact('grades', 'curriculums', 'selectedGrade'));
    
        //
    }
    /** 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function showCurriculumEdit($id)
    {
        $curriculums = Curriculum::with('grade')->find($id);

        if (is_null($curriculums)) {
            \Session::flash('err_msg','データがありません');
            return redirect(route('admin.show.curriculum.list'));
        }

        $grades = Grade::all();

        return view('admin.layouts.curriculum_edit' , [
            'curriculums' => $curriculums,
            'grade_id' => $curriculums->grade_id ,
            'grades' => $grades
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function exeCurriculumUpdate(CurriculumRequest $request, $id)
    {
        $curriculum = Curriculum::find($id);

        if (!$curriculum) {
            \Session::flash('err_msg', 'データが見つかりません');
            return redirect(route('admin.show.curriculum.list'));
        }            

        \DB::beginTransaction();
        try {
    
            $curriculum->fill($request->only(['title', 'video_url', 'description', 'grade_id']));
            $curriculum->alway_delivery_flg = $request->input('alway_delivery_flg') == '1' ? 1 : 0;


            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');

                if ($file->isValid()) {
                    $originalName = $file->getClientOriginalName(); // ← 元のファイル名を取得
                    $safeName = time() . '_' . preg_replace('/[^A-Za-z0-9\.\-_]/', '_', $originalName);
                    $path = $file->storeAs('thumbnails', $safeName, 'public'); // ← 指定して保存
                    $curriculum->thumbnail = $safeName; // ← DBに保存するパス
                    }
                }
    

            $curriculum->save();
            \DB::commit();
    
        } catch(\Throwable $e) {
            \DB::rollback();
            abort(500);
        }
    
        \Session::flash('err_msg','授業を更新しました');
        return redirect(route('admin.show.curriculum.list', ['grade_id' => $curriculum->grade_id]));
    
    }
        //

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curriculum $curriculum)
    {
        //
    }

    public function filterCurriculums(Request $request)
    {

        $grade_id = $request->grade_id;
        $curriculums = Curriculum::where('grade_id', $grade_id)->paginate(6);
        $selectedGrade = Grade::find($grade_id);

        $isAjaxOnly = $request->ajax() || $request->input('ajaxOnly');

        return view('admin.layouts.curriculum_list', [
            'curriculums' => $curriculums,
            'selectedGrade' => $selectedGrade,
            'ajaxOnly' => $request->ajax()
        ]);
    }
}