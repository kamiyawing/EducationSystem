@extends('layouts.app')

@section('content')
    <div class="container">
        <button onclick="location.href='{{ route('article_list') }}'">←戻る</button>
        <h1>お知らせ変更</h1>
        <form action="{{ route('articles_update', ['id' => $articles->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div>
                <table class="table">
                    <tr>
                        <th>投稿日時</th>
                        <td>
                            <input type="datetime-local" name="posted_date" class="form-control form-control-lg" value="{{ $articles->posted_date }}" >
                            @error('posted_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>タイトル</th>
                        <td>
                            <input type="text" name="title" class="form-control form-control-lg" value="{{ $articles->title }}">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th>本文</th>
                        <td>
                            <input type="text" name="article_contents" class="form-control form-control-lg" value="{{ $articles->article_contents }}">
                            @error('article_contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-success">登録</button>
            </div>
        </form>
    </div>
@endsection