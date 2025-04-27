@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <button onclick="location.href='{{ route('usersTop') }}'">←戻る</button>
        </div>
        <p>{{ $articles->posted_date }}</p>
        <h1>{{ $articles->title }}</h1>
        <div>{{ $articles->article_contents }}</div>
    </div>


@endsection