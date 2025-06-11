@extends('user.layouts.app')

@section('title', '授業進捗')

@section('content')
<div class="container py-4">
    <!-- ナビゲーションボタン -->
    <div class="row mb-3 text-center">
        <div class="col-md-3 mb-2">
            <a href="{{ route('schedule.index') }}" class="btn btn-primary w-100">時間割</a>
        </div>
        <div class="col-md-3 mb-2">
            <a href="{{ route('progress.index') }}" class="btn btn-success w-100">授業進捗</a>
        </div>
        <div class="col-md-3 mb-2">
            <a href="{{ route('profile.edit') }}" class="btn btn-info w-100">プロフィール設定</a>
        </div>
        <div class="col-md-3 mb-2">
            <a href="{{ route('logout') }}" class="btn btn-danger w-100"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>

    <!-- 戻るボタン -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <a href="{{ route('previous.page') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>

    <!-- 授業動画セクション -->
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2 text-center">
            <img src="{{ asset('images/lesson_video.jpg') }}" alt="授業動画" class="img-fluid rounded">
        </div>
    </div>

    <!-- 学年、授業タイトル、講座内容 -->
    <div class="row mb-4">
        <div class="col-md-8 offset-md-2">
            <h4 class="text-center">学年: 小学校5年生</h4>
            <h5 class="text-center mt-3">授業タイトル: 日本の歴史</h5>
            <p class="mt-3">この講座では、日本の歴史をわかりやすく学びます。重要な時代や出来事について詳しく解説しています。</p>
        </div>
    </div>

    <!-- 受講しましたボタン -->
    <div class="row">
        <div class="col-md-12 text-center">
        @if(!$progress->completed)
            <form method="POST" action="{{ route('lesson.clear') }}">
                @csrf
                <button type="submit" class="btn btn-success">受講しました</button>
            </form>
        @else
            <button class="btn btn-secondary" disabled>受講済み</button>
        @endif

        </div>
    </div>
</div>
@endsection
