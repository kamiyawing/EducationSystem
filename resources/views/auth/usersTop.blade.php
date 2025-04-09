@extends('layouts.app')

@section('content')
    <div>
            <h1>ユーザートップ画面</h1>
            <div>
                <button onclick="location.href='{{ route('usersEdit') }}'">プロフィール設定</button>
            </div>
    </div>


@endsection