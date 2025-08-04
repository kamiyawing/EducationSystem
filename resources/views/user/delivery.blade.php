@extends('user.layouts.app')

@section('title', '配信ページ')

@section('content')
<div class="container py-4">
    @if(isset($deliveries))
        <!-- 一覧表示 -->
        <h2 class="text-center mb-4">配信一覧</h2>
        <div class="row">
            @foreach($deliveries as $delivery)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($delivery->thumbnail)
                            <img src="{{ asset($delivery->thumbnail) }}" class="card-img-top" alt="サムネイル">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $delivery->title }}</h5>
                            <p class="card-text">配信開始: {{ $delivery->start_time }}</p>
                            <a href="{{ route('delivery.show', $delivery->id) }}" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @elseif(isset($delivery))
        <!-- 詳細表示 -->
        <h2 class="text-center mb-4">{{ $delivery->title }} - 配信詳細</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {{-- サムネイル --}}
                        @if($delivery->thumbnail)
                            <div class="text-center mb-3">
                                <img src="{{ asset($delivery->thumbnail) }}" class="img-fluid rounded" alt="サムネイル">
                            </div>
                        @endif

                        {{-- 授業タイトル --}}
                        <h4 class="card-title">{{ $delivery->curriculum->title ?? $delivery->title }}</h4>

                        {{-- 授業内容 --}}
                        <p class="card-text">{{ $delivery->curriculum->description ?? '授業内容が未登録です' }}</p>

                        {{-- 学年 --}}
                        <div class="mb-3">
                            <strong>学年:</strong> {{ $delivery->curriculum->grade->name ?? '未設定' }}
                        </div>

                        {{-- 配信時間 --}}
                        <div class="mb-3">
                            <strong>配信開始:</strong> {{ $delivery->start_time }}<br>
                            <strong>配信終了:</strong> {{ $delivery->end_time }}
                        </div>

                        {{-- 配信期間チェック --}}
                        @if($can_view)
                            {{-- 動画表示 --}}
                            @if ($delivery->video_path)
                                <video controls width="100%" class="mb-3">
                                    <source src="{{ asset($delivery->video_path) }}" type="video/mp4">
                                    お使いのブラウザは動画再生に対応していません。
                                </video>
                            @elseif ($delivery->curriculum->video_url)
                                <iframe width="100%" height="315"
                                    src="{{ $delivery->curriculum->video_url }}"
                                    frameborder="0"
                                    allowfullscreen>
                                </iframe>
                            @else
                                <p>動画は未登録です</p>
                            @endif

                            {{-- 受講ボタン --}}
                            @if(auth()->check())
                                @php
                                    $progress = auth()->user()
                                        ->curriculumProgress
                                        ->firstWhere('curriculum_id', $delivery->curriculum_id);
                                @endphp

                                @if($progress && $progress->clear_flg === 1)
                                    <div class="alert alert-success mt-3">受講済みです</div>
                                @else
                                    <div class="mt-3">
                                        <form action="{{ route('delivery.complete', $delivery->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success w-100">受講しました</button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        @else
                            {{-- 配信期間外メッセージ --}}
                            <div class="alert alert-warning text-center">
                                この授業は現在閲覧できません。配信期間外です。
                            </div>
                        @endif

                        {{-- 戻るボタン --}}
                        <div class="mt-3">
                            <a href="{{ route('delivery.index') }}" class="btn btn-secondary w-100">戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- データがない場合 -->
        <p class="text-center">表示するデータがありません。</p>
    @endif
</div>
@endsection
