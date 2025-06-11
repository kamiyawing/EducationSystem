@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <button onclick="location.href='{{ route('adminTop') }}'">←戻る</button>
            <h1>お知らせ一覧</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div>
            <button onclick="location.href='{{ route('article_create') }}'" class="btn btn-success">新規登録</button>
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
                  <tr>
                      <td>{{ $article->posted_date }}</td>
                      <td>{{ $article->title }}</td>
                      <td>
                        <div style="display: flex;">
                            <button onclick="location.href='{{ route('articles_edit', ['id' => $article->id]) }}'" class="btn btn-success">変更する</button>
                            <form action="{{ route('articles_delete', ['id' => $article->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </div>
                      </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>


@endsection