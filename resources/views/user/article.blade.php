@extends('user.layouts.app')

@section('title', 'お知らせ')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">お知らせ一覧</h2>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            @foreach ($articles as $article)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 100, '...') }}</p>
                        <p class="text-muted">投稿日: {{ $article->created_at->format('Y年m月d日') }}</p>
                        <a href="{{ route('article.show', ['id' => $article->id]) }}" class="btn btn-primary">
                            詳細を見る
                        </a>
                    </div>
                </div>
            @endforeach

            @if ($articles->isEmpty())
                <p class="text-center">現在、お知らせはありません。</p>
            @endif
        </div>
    </div>
</div>
@endsection
