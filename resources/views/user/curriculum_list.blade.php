@extends('user.layouts.app')

@section('content')

@php
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

     $gradeColors = [
        1 => 'info',
        2 => 'info',
        3 => 'info',
        4 => 'info',
        5 => 'info',
        6 => 'info',
        7 => 'primary',
        8 => 'primary',
        9 => 'primary',
        10 => 'success',
        11 => 'success',
        12 => 'success',
        ];

        $currentMonth = request('month') ?? now()->month;
        $currentYear = request('year') ?? now()->year;

        $date = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1);

        $prev = $date->copy()->subMonth();
        $next = $date->copy()->addMonth();
        @endphp

{{-- 戻るボタン --}}
    <a href="{{ route('user.top') }}" class="btn btn-secondary">戻る</a>
    <div class="container mt-4">
    <h1>授業管理画面</h1>


    

    <div class="row">
        {{-- 左カラム：学年ボタン --}}
        <div class="col-md-4">

        {{-- 月別表示 --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{-- 前月へ行く --}}
        <a href="{{ route('user.curriculum_list', ['month' => $prev->month, 'year' => $prev->year, 'grade_id' => request('grade_id')]) }}"
           class="btn btn-outline-secondary">◀︎</a>

        {{-- 表示月 --}}
        <h4 class="mb-0">{{ $date->year }}年{{ $date->month }}月</h4>

        {{--翌月へ行く --}}
        <a href="{{ route('user.curriculum_list', ['month' => $next->month, 'year' => $next->year, 'grade_id' => request('grade_id')]) }}"
           class="btn btn-outline-secondary">▶︎</a>

        @if(request('grade_id'))
           <span class="ms-2 badge bg-info">
            {{ $grades[request('grade_id') ?? '学年不明']}}
           </span>
        @endif
    </div>
    

    <div class="btn-group-vertical w-100">
        @foreach($grades as $id => $label)
          @php
           $color = $gradeColors[$id] ?? 'outline-primary';
          @endphp
        <a href="{{ route('user.curriculum_list', ['grade_id' => $id]) }}" class="btn btn-{{ $color }} mb-3 rounded-pill px-4 py-2 {{ request('grade_id') == $id ? 'active' : '' }}">{{ $label }}</a>
        @endforeach
    </div>
    </div>


    

    {{-- 右カラム：カリキュラム一覧 --}}
    <div class="col-md-8">
    @if($curriculums->isEmpty())
        <p>表示できるカリキュラムがありません。</p>
    @else

    
        <div class="row">
            @foreach($curriculums as $curriculum)
                {{-- 常時フラグと学年一致で表示させるとこ --}}
                @if($curriculum->always_delivery_flg == 1 || $curriculum->grade_id == request('grade_id'))
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        {{-- サムネイル --}}
                        @if($curriculum->thumbnail)
                            <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" class="card-img-top" alt="サムネイル">
                        @endif

                        <div class="card-body d-flex flex-column">
                            {{--タイトル --}}
                            <h5 class="card-title">{{ $curriculum->title }}</h5>

                            {{-- 授業説明 --}}
                            <p class="card-text">{{ $curriculum->description }}</p>

                            {{--日時表示 --}}
                            @foreach($curriculum->deliveryTimes as $time)
                               <p class="card-text">
                                   配信期間：{{ c::parse($time->delivery_from)->format('Y年m月d日 H:i') }}
                                   ~ {{ \Carbon\Carbon::parse($time->delivery_to)->format('Y年m月d日 H:i') }}
                               </p>
                            @endforeach

                            {{--リンク --}}
                            @if($curriculum->video_url)
                                <a href="{{ $curriculum->video_url }}" class="btn btn-primary" target="_blank">動画を見る</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection