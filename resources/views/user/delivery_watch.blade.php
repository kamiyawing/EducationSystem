@extends('user.layouts.app')

@section('title', '視聴ページ')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">{{ $delivery->title }} - 視聴ページ</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    @if ($can_view)
                        @if ($delivery->video_path)
                            <video controls width="100%" class="mb-3">
                                <source src="{{ asset($delivery->video_path) }}" type="video/mp4">
                                お使いのブラウザは動画再生に対応していません。
                            </video>
                        @else
                            <div class="alert alert-info text-center">
                                視聴可能な動画が準備されていません。
                            </div>
                        @endif

                        <a href="{{ route('delivery.complete', $delivery->id) }}" class="btn btn-primary w-100 mb-2">
                            受講完了
                        </a>
                    @else
                        <div class="alert alert-warning text-center">
                            この教材は現在視聴できません。配信期間外です。
                        </div>
                    @endif

                    <a href="{{ route('delivery.show', $delivery->id) }}" class="btn btn-secondary w-100">
                        戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
