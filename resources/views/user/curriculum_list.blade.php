@extends('user.layouts.app')

@section('content')

{{-- 戻るボタン --}}
    <a href="{{ route('user.top') }}" class="btn btn-secondary">戻る</a>

    <div class="container mt-4">
    <h1>授業管理画面</h1>

    @if($curriculums->isEmpty())
        <p>表示できるカリキュラムがありません。</p>
    @else
        <div class="row">
            @foreach($curriculums as $curriculum)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($curriculum->thumbnail)
                            <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" class="card-img-top" alt="サムネイル">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $curriculum->title }}</h5>
                            <p class="card-text">{{ $curriculum->description }}</p>
                            @if($curriculum->video_url)
                                <a href="{{ $curriculum->video_url }}" class="btn btn-primary" target="_blank">動画を見る</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection