@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ユーザートップ画面</h1>
        <div>
            <button onclick="location.href='{{ route('usersEdit') }}'">プロフィール設定</button>
            <button onclick="location.href='{{ route('userProgress') }}'">授業進捗</button>
        </div>
        @if ($articles->isEmpty())
        <p>現在お知らせはありません。</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>投稿日時</th>
                    <th>タイトル</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                <tr data-article-id="{{ $article->id }}" style="cursor: pointer;">
                    <td>{{ $article->posted_date }}</td>
                    <td>{{ $article->title }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>


@endsection