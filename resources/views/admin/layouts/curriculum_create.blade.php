@extends('admin.layouts.app')
@section('content')
  <div class="mt-3">
    <a class="link-secondary d-inline link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fs-4" 
    href="{{ route('admin.show.curriculum.list') }}">
      戻る
    </a>
  </div>
  <div class="d-flex flex-column gap-3 my-4">
    <h1 class="display-6 ">授業新規登録</h1>
  </div>

  <form method="POST" action="{{ route('admin.exe.curriculum.store') }}" enctype="multipart/form-data">
  @csrf
    <div class="row mb-3 fs-3">
        <label for="thumbnail" class="col-sm-2 col-form-label">サムネイル</label>
        <div class="col-sm-8 mt-2">
          <input class="form-control" style="border-color:gray; border-width: 2px;" type="file" id="thumbnail" name="thumbnail" placeholder="ファイルを選択">
            @if ($errors->has('thumbnail'))
            <div class="text-danger">
              {{ $errors->first('thumbnail') }}
            </div>
            @endif
            <div class="mt-3">
              <img src="{{ asset('images/noimage.png') }}" alt="No Image" class="img-thumbnail" style="max-width: 300px;">
            </div>
        </div>
    </div>
    <div class="row mb-3 fs-3">
        <label for="grade_id" class="col-sm-2 col-form-label">学年</label>
        <div class="col-sm-4 mt-2">
          <select class="form-select col-sm-8" style="border-color:gray; border-width: 2px;" aria-label="Default select example" id="grade_id" name="grade_id">
              @foreach($grades as $grade)
                <option value="{{ $grade->id }}"
                  {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                  {{ $grade->name }}</option>
              @endforeach
              @if ($errors->has('grade_id'))
              <div class="text-danger">
                {{ $errors->first('grade_id') }}
              </div>
              @endif
          </select>
        </div>
    </div>
    <div class="row mb-3 fs-3">
      <label for="title" class="col-sm-2 col-form-label">授業名</label>
      <div class="col-sm-8 mt-2">
        <input type="text" class="form-control" style="border-color:gray; border-width: 2px;" id="title" name="title"
        value="{{ old('title') }}" >
          @if ($errors->has('title'))
          <div class="text-danger">
            {{ $errors->first('title') }}
          </div>
          @endif
      </div>
    </div>
    <div class="row mb-3 fs-3">
        <label for="video_url" class="col-sm-2 col-form-label">動画URL</label>
        <div class="col-sm-8 mt-2">
          <input type="text" class="form-control" style="border-color:gray; border-width: 2px;" id="video_url" name="video_url"
          value="{{ old('video_url') }}" >
            @if ($errors->has('video_url'))
            <div class="text-danger">
              {{ $errors->first('video_url') }}
            </div>
            @endif
        </div>
    </div>
    <div class="row mb-5 fs-3">
        <label for="description" class="col-sm-2 col-form-label">授業概要</label>
        <div class="col-sm-8 mt-2">
          <textarea class="form-control" style="border-color:gray; border-width: 2px;" rows="3" id="description" name="description">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
            <div class="text-danger">
              {{ $errors->first('description') }}
            </div>
            @endif
        </div>
    </div>
    <div class="form-check mb-3 fs-3 ms-5">
        <input type="hidden" name="alway_delivery_flg" value="0">
        <input class="form-check-input" type="checkbox" value="1" id="alway_delivery_flg" name="alway_delivery_flg" checked>
        <label class="form-check-label" for="alway_delivery_flg">常時公開</label>
    </div>
    <div class="text-center mt-3">
      <button type="submit" class="btn btn-primary fs-3">登録</button>
    </div>
  </form>

@endsection