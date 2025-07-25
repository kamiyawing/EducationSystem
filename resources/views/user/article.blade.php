@extends('user.layouts.app')

@section('title', 'お知らせ詳細')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h2>{{ $article->articles }}</h2>
            <small>{{ $article->created_at->format('Y-m-d') }}</small>
        </div>
        <div class="card-body">
            <!-- 記事の本文などをここで表示 -->
            <p>{{ $article->content }}</p>
        </div>
    </div>
</div>
@endsection
