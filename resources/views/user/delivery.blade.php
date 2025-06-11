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
                        @if($delivery->thumbnail)
                            <div class="text-center mb-3">
                                <img src="{{ asset($delivery->thumbnail) }}" class="img-fluid rounded" alt="サムネイル">
                            </div>
                        @endif

                        <h4 class="card-title">{{ $delivery->title }}</h4>
                        <p class="card-text">{{ $delivery->description }}</p>

                        <!-- 学年の追加 -->
                        <div class="mb-3">
                            <strong>学年:</strong> {{ $delivery->grade ?? '未設定' }}
                        </div>

                        <div class="mb-3">
                            <strong>配信開始:</strong> {{ $delivery->start_time }}<br>
                            <strong>配信終了:</strong> {{ $delivery->end_time }}
                        </div>

                        @if(now()->between($delivery->start_time, $delivery->end_time))
                            <a href="{{ route('delivery.watch', $delivery->id) }}" class="btn btn-primary w-100">視聴開始</a>
                        @else
                            <button class="btn btn-secondary w-100" disabled>配信時間外</button>
                        @endif
                        <!-- 受講済み状態チェック -->
                        @if(auth()->check() && auth()->user()->completedDeliveries->contains($delivery->id))
                            <div class="alert alert-success mt-3">受講済みです</div>
                        @else
                        <!-- 受講しましたボタンを追加 -->
                        <div class="mt-3">
                            <form action="{{ route('delivery.complete', $delivery->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-100">受講しました</button>
                            </form>
                        </div>
                        @endif
                        <!-- 戻るボタンを追加 -->
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
