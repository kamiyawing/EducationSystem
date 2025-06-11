@extends('user.layouts.app')


@section('title', '授業管理一覧')

@section('content')
<div class="container py-4">
    <!-- 上部ナビゲーションボタン -->
    <div class="row mb-3 text-center">
        <div class="col-md-2 mb-2">
            <a href="{{ route('curriculums.index') }}" class="btn btn-primary w-100">授業管理</a>
        </div>
        <div class="col-md-2 mb-2">
            <a href="{{ route('announcements.index') }}" class="btn btn-success w-100">お知らせ管理</a>
        </div>
        <div class="col-md-2 mb-2">
            <a href="{{ route('banners.index') }}" class="btn btn-info w-100">バナー管理</a>
        </div>
        <div class="col-md-2 mb-2">
            <a href="{{ route('logout') }}" class="btn btn-danger w-100"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="col-md-2 mb-2">
            <a href="{{ route('home') }}" class="btn btn-secondary w-100">戻る</a>
        </div>
        
    </div>

    <!-- 学年表示と選択 -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h4>選択中の学年: {{ $selectedGrade->name ?? '未選択' }}</h4>
            <div class="mt-3">
                @foreach ($grades as $grade)
                    <form method="POST" action="{{ route('curriculums.filterByGrade', $grade->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">{{ $grade->name }}</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 授業一覧 -->
    <div class="row">
        @foreach ($curriculums as $curriculum)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <!-- サムネイル画像 -->
                    <img src="{{ asset($curriculum->thumbnail) }}" class="card-img-top" alt="授業サムネイル">

                    <!-- 授業情報 -->
                    <div class="card-body">
                        <h5 class="card-title">{{ $curriculum->title }}</h5>
                        <p class="card-text">配信日時: {{ $curriculum->delivery_time }}</p>
                        <div class="mt-3">
                            <!-- 授業内容編集ボタン -->
                            <a href="{{ route('curriculums.edit', $curriculum->id) }}" class="btn btn-secondary">授業内容編集</a>
                            <!-- 配信日時編集ボタン -->
                            {{-- <a href="{{ route('deliveryTimes.edit', $curriculum->id) }}" class="btn btn-secondary">配信日時編集</a> --}}

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
