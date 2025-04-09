@extends('admin.layouts.app')
@section('content')
  <div class="d-flex flex-column gap-3 my-4">
    <a class="link-secondary link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fs-4" href="#">
      戻る
    </a>
    <h1 class="display-6 ">授業一覧</h1>
  </div>

  <div class="d-flex align-items-center my-4">
    <a href="#" class="btn btn-success btn-lg">新規登録</a>
    <h1 class="display-4 mb-3 px-5 mx-auto fw-bold border border-5 border-black rounded-pill bg-info-subtle">
      {{ $selectedGrade->name ?? 'すべてのカリキュラム' }}
    </h1>
  </div>

  <div class="row mt-5 min-vh-100">
    <div class="col-12 col-md-2 mb-4 mt-5">
      <div class="d-flex flex-column gap-4 text-center">
      @foreach($grades as $grade)
        <a href="{{ route('admin.curriculum.by_grade', ['grade_id' => $grade->id]) }}">
          <button class="btn btn-outline-info">{{ $grade->name }}</button>
        </a>
      @endforeach
      </div>
    </div>
    
    <div class="col-12 col-md-9">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($curriculums as $curriculum)
        <div class="col">
          <div class="card h-100">
            @if (!empty($curriculum->thumbnail))
              <img src="https://picsum.photos/640/480?random=1" class="card-img-top" alt="サムネイル画像" style="height: 200px; object-fit: cover;">
              @else
              <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 200px;">
                No Image
              </div>
            @endif
            <div class="card-body">
              <h4 class="card-title fw-light">{{ $curriculum->title}}</h4>
              <h6 class="card-text">
                @if($curriculum->alway_delivery_flg == 1)
                  常時公開
                @else
                  @if($curriculum->delivery_times->isNotEmpty())
                    @foreach($curriculum->delivery_times as $time)
                    {{ \Carbon\Carbon::parse($time->delivery_from)->format('m月d日 H:i') }} 
                    〜 
                    {{ \Carbon\Carbon::parse($time->delivery_to)->format('m月d日 H:i') }}<br/>
                    @endforeach
                  @else
                    常時公開
                  @endif
                @endif
              </h6>
            </div>
            <div class="card-footer text-center">
              <button class="btn btn-light btn-sm">授業内容編集</button>
              <button class="btn btn-light btn-sm">配信日時編集</button>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

<div class="d-flex justify-content-center">
  {{ $curriculums->links('pagination::bootstrap-5') }}
</div>
    
@endsection
