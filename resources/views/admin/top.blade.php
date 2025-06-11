@extends('layouts.app')

@section('content')
    <div>
            <h1>管理トップ画面</h1>
            <div>
                <button onclick="location.href='{{ route('article_list') }}'">お知らせ管理</button>
            </div>
    </div>


@endsection