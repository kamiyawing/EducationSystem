@extends('layouts.app')

@section('content')

{{-- 戻るボタン --}}
    <a href="{{ route('user.top') }}" class="btn btn-secondary">戻る</a>


    <div class="container">
        <h1>授業管理画面</h1>
    </div>
@endsection