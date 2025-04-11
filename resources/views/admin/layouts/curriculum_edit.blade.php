@extends('admin.layouts.app')
@section('content')
  <div class="mt-3">
    <a class="link-secondary d-inline link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fs-4" 
    href="{{ route('admin.curriculum.by_grade', ['grade_id' => $grade_id]) }}">
      戻る
    </a>
  </div>
  <div class="d-flex flex-column gap-3 my-4">
    <h1 class="display-6 ">授業設定</h1>
  </div>

  <form method="POST" action="{{ route('admin.exe.curriculum.update' , ['id' => $curriculums->id]) }}" enctype="multipart/form-data">
    <div class="row mb-3 fs-3">
        <label for="thumbnail" class="col-sm-2 col-form-label">サムネイル</label>
        <div class="col-sm-8 mt-2">
          <input class="form-control" style="border-color:gray; border-width: 2px;" type="file" id="thumbnail" placeholder="ファイルを選択"
          value="{{ old('thumbnail', $curriculums -> thumbnail) }}">
        </div>
    </div>
    <div class="row mb-3 fs-3">
        <label for="grade" class="col-sm-2 col-form-label">学年</label>
        <div class="col-sm-4 mt-2">
          <select class="form-select col-sm-8" style="border-color:gray; border-width: 2px;" aria-label="Default select example" id="grade">
              @foreach($grades as $grade)
                <option value="{{ $grade->id }}"
                  @if ($grade->id == $curriculums->grade_id) selected @endif>
                  {{ $grade->name }}</option>
              @endforeach
          </select>
        </div>
    </div>
    <div class="row mb-3 fs-3">
      <label for="title" class="col-sm-2 col-form-label">授業名</label>
      <div class="col-sm-8 mt-2">
        <input type="text" class="form-control" style="border-color:gray; border-width: 2px;" id="title"
        value="{{ old('title', $curriculums->title) }}">
      </div>
    </div>
    <div class="row mb-3 fs-3">
        <label for="video_url" class="col-sm-2 col-form-label">動画URL</label>
        <div class="col-sm-8 mt-2">
          <input type="text" class="form-control" style="border-color:gray; border-width: 2px;" id="video_url"
          value="{{ old('video_url', $curriculums->video_url) }}">
        </div>
    </div>
    <div class="row mb-5 fs-3">
        <label for="description" class="col-sm-2 col-form-label">授業概要</label>
        <div class="col-sm-8 mt-2">
            <textarea class="form-control" style="border-color:gray; border-width: 2px;" id="description" rows="3">{{ old('description', $curriculums->description) }}</textarea>
        </div>
    </div>
    <div class="form-check mb-3 fs-3 ms-5">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
        <label class="form-check-label" for="flexCheckChecked">常時公開</label>
    </div>
    <div class="text-center mt-3">
    <button type="submit" class="btn btn-primary fs-3">登録</button>
    </div>
  </form>

@endsection